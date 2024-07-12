from datetime import date, timedelta, datetime
from flask import Flask, request
import requests
import concurrent.futures
import sys
import time
import random
import re
import pandas as pd
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium_stealth import stealth
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.proxy import Proxy, ProxyType
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC
from flask_mysqldb import MySQL
from apscheduler.schedulers.background import BackgroundScheduler
import atexit

LOAD_PAUSE_TIME = 5
SCROLL_PAUSE_TIME = 5
WEB_PAUSE_TIME = 5

MAX_SEARCH_TIME = 5

app = Flask(__name__)

app.config['MYSQL_HOST'] = '127.0.0.1'
app.config['MYSQL_USER'] = 'scanlolo_scproject1'
app.config['MYSQL_PASSWORD'] = 'iGU^Eail1I#I'
app.config['MYSQL_DB'] = 'scanlolo_scproject1'
app.config['MYSQL_CHARSET'] = 'utf8mb4'

self_url = 'http://127.0.0.1:5000'
login_username = 'scanlolo'
password = '065382212'

# Initialize MySQL
mysql = MySQL(app)

def check_database_mins():
    with app.app_context():
        try:
            cur = mysql.connection.cursor()
            cur.execute("SELECT customer_id, query, schedule_times, frequency, isActive FROM scheduled_searches")
            rows = cur.fetchall()
            for row in rows:
                user_id = row[0]
                query = row[1]
                schedule_times = row[2].replace('[', '').replace(']', '').replace('"', '').replace(' ', '').split(',')
                frequency = row[3]
                is_active = row[4]
                
                if frequency == 'daily' and is_active:
                    current_time = datetime.now().strftime('%H:%M')
                    if current_time in schedule_times:
                        response = requests.post(self_url+'/scrape', data={'query': query})
                        html = response.text

                        cur.execute("INSERT INTO search_entries (query, customer_id, created_at) VALUES (%s, %s, NOW())", (query, user_id))

                        print("Daily schedule matched at:", current_time)
                        return response.status_code
                    
            cur.close()
            print("MySQL database checked successfully minutely.")
        except Exception as e:
            print("Error accessing MySQL database:", e)

def check_database_daily():
    with app.app_context():
        try:
            cur = mysql.connection.cursor()
            cur.execute("SELECT customer_id, query, schedule_times, frequency, isActive FROM scheduled_searches")
            rows = cur.fetchall()
            for row in rows:
                user_id = row[0]
                query = row[1]
                schedule_times = row[2].split(',')
                frequency = row[3]
                is_active = row[4]

                if frequency == 'weekly' and is_active:
                    current_day = datetime.now().strftime('%A')
                    if current_day in schedule_times:
                        response = requests.post(self_url+ '/scrape', data={'query': query})
                        html = response.text

                        cur.execute("INSERT INTO search_entries (query, customer_id, created_at) VALUES (%s, %s, NOW())", (query, user_id))

                        print("Weekly schedule matched on:", current_day)
                        return response.status_code
                elif frequency == 'monthly' and is_active:
                    current_date = datetime.now().day
                    if str(current_date) in schedule_times:
                        response = requests.post(self_url+'/scrape', data={'query': query})
                        html = response.text

                        cur.execute("INSERT INTO search_entries (query, customer_id, created_at) VALUES (%s, %s, NOW())", (query, user_id))

                        print("Monthly schedule matched on:", current_date)
                        return response.status_code
                    
            cur.close()
            print("MySQL database checked successfully daily and monthly.")
        except Exception as e:
            print("Error accessing MySQL database:", e)

def create_new_search(query, post_titles, image_urls, page_urls, descriptions, replies, locations, usernames, updated_at, created_dates):
    with app.app_context():
        try:
            # Connect to MySQL
            cursor = mysql.connection.cursor()

            # Create table query
            create_table_query = f'''
            CREATE TABLE IF NOT EXISTS `{query}` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                post_title VARCHAR(255),
                image_url VARCHAR(1000),
                page_url VARCHAR(1000),
                description VARCHAR(10000),
                reply VARCHAR(255),
                location VARCHAR(255),
                username VARCHAR(255),
                updated_at VARCHAR(255),
                created_date VARCHAR(255)
            )
            '''
            cursor.execute(create_table_query)

            # Insert data into the table
            for i in range(len(post_titles)):
                try:
                    insert_query = f'''
                    INSERT INTO `{query}` (post_title, image_url, page_url, description, reply, location, username, updated_at, created_date)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)
                    '''
                    data = list((post_titles[i], image_urls[i], page_urls[i], descriptions[i], str(replies[i]), locations[i], usernames[i], updated_at[i], created_dates[i]))
                    cursor.execute(insert_query, data)
                    mysql.connection.commit()
                except Exception as e:
                    print("Error could not commit " + post_titles[i] + " to table")

            cursor.close()
        except Exception as e:
            exc_type, exc_obj, exc_tb = sys.exc_info()
            print(e, exc_tb.tb_lineno)

with open('proxies.txt', 'r') as f:
    proxies = [line.strip() for line in f.readlines()]

def create_driver_with_proxy(proxy=""):
    ip, port, user, password = proxy.split(':')
    
    # Create a proxy object
    proxy_obj = Proxy()
    proxy_obj.proxy_type = ProxyType.MANUAL
    proxy_obj.http_proxy = f"{ip}:{port}"
    proxy_obj.ssl_proxy = f"{ip}:{port}"

    # Add authentication to the proxy
    proxy_url = f"http://{user}:{password}@{ip}:{port}"

    # Configure Chrome options
    
    op = webdriver.ChromeOptions()
    #op.add_argument(f"--proxy-server={proxy_url}")
    op.add_argument("window-size=1920,1080")
    #op.add_argument('headless')
    op.add_argument('--ignore-certificate-errors')
    op.add_argument('--ignore-ssl-errors')
    op.add_argument('--disable-extensions')
    op.add_argument('--disable-logging')
    op.add_argument('--log-level=3')
    op.add_experimental_option("excludeSwitches", ["enable-automation"])
    op.add_experimental_option('useAutomationExtension', False)
    op.binary_location = r"C:\Program Files\Google\Chrome\Application\chrome.exe"
    op.add_argument("webdriver.chrome.driver=C:\\Program Files\\chromedriver-win64\\chromedriver-win64\\chromedriver.exe")
    driver = webdriver.Chrome(options=op)

    return driver

# Initialize the scheduler
scheduler = BackgroundScheduler()
scheduler.add_job(check_database_mins, 'interval', minutes=1)
scheduler.add_job(check_database_daily, 'interval', days=1)
scheduler.start()

# Ensure the scheduler shuts down when the Flask app stops
atexit.register(lambda: scheduler.shutdown())

def scraper_helper(i, divs, post_titles, image_urls, page_urls, descriptions, replies, locations, usernames, created_dates, updated_at):
    a_tag = divs[i].find("a", attrs={"data-testid": "post-title-link"})
    img_tag = divs[i].find("div", attrs={"data-testid": "post-thumbnail"})
    username_tag = divs[i].find("a", attrs={"data-testid": "post-author_username"})
    updated_tag = divs[i].find("span", attrs={"dir": "rtl"})
    city_tag = divs[i].find("a", href=lambda href: href and 'city' in href)

    if a_tag and username_tag and city_tag:
        if img_tag:
            image_urls[i] = (img_tag.find("img").get("srcset").split(',')[0])
        
        href = a_tag.get("href")
        driver = create_driver_with_proxy(random.choice(proxies))
        driver.get("https://haraj.com.sa/" + href)
        soup = BeautifulSoup(driver.page_source, 'html.parser')
        article_tag = soup.find("article", attrs={"data-testid": "post-article"})
        if article_tag:
            post_comments_list = driver.find_element(By.CSS_SELECTOR, "[data-testid='post-comments-list']")
            comment_divs = post_comments_list.find_elements(By.TAG_NAME, "div")
            comment_divs = comment_divs[:3]

            #extract date from img srcset attribute
            url_date = None
            img_tags = soup.find_all("img")
            if img_tags:                                    
                for img_t in img_tags:                                                
                    if img_t.get("srcset"):                                         
                        url_date = img_t.get("srcset").split('/')[4]
                        break
                                
            if url_date:
                created_dates[i] = (url_date)

            page_urls[i] = (href)
            descriptions[i] = (article_tag.text.strip())                          
            post_titles[i] = (a_tag.text)
            usernames[i] = (username_tag.text)
            locations[i] = (city_tag.text)
            updated_at[i] = (updated_tag.text)
            replies[i] = ([d.text for d in comment_divs])
        driver.quit()

def table_exists(table_name):
    try:
        # Connect to MySQL
        cur = mysql.connection.cursor()

        # Check if table exists
        cur.execute(f"SHOW TABLES LIKE '{table_name}'")
        result = cur.fetchone()

        # Close the cursor
        cur.close()

        if result:
            return True
        else:
            return False

    except Exception as e:
        print(f"Error checking if table exists: {str(e)}")
        return False

def get_latest_posts(query, divs):
    if table_exists(query):
        latest_title = ''
        cur = mysql.connection.cursor()
        try:
            cur.execute(f"SELECT post_title FROM `{query}` ORDER BY id LIMIT 1")
            latest_title = cur.fetchone()[0]
        except Exception as e:
            print(e)
        cur.close()
        print(latest_title, "<------ HERE")
        for i in range(len(divs)):
            a_tag = divs[i].find("a", attrs={"data-testid": "post-title-link"})
            if latest_title == a_tag.text:
                return(i)
    else:
        return(-1)
    
@app.route('/scrape', methods=['POST'])
def scrape():
    query = request.form.get('query')
    if query is None:
        return "No query parameter provided", 400
        
    enc_query = query.replace(' ', '%20')
    url = 'https://haraj.com.sa/search/' + enc_query + '/'

    driver = create_driver_with_proxy(random.choice(proxies))
    driver.get(url)
    try:
        WebDriverWait(driver, WEB_PAUSE_TIME).until(EC.presence_of_element_located((By.ID, 'postsList')))
        load_more_button = WebDriverWait(driver, WEB_PAUSE_TIME).until(EC.presence_of_element_located((By.CSS_SELECTOR, '[data-testid="posts-load-more"]')))
        load_more_button.click()
            
        # Scroll down for 10 seconds
        start_time = time.time()
        while time.time() - start_time < MAX_SEARCH_TIME:
            driver.execute_script("window.scrollBy(0, document.body.scrollHeight);")
            time.sleep(1)

        soup = BeautifulSoup(driver.page_source, 'html.parser')
        posts_list_div = soup.find("div", id="postsList")

        if posts_list_div:
        # Iterate through the divs inside it
            divs = posts_list_div.find_all("div", attrs={"data-testid": "post-item"})
            driver.quit()

            post_titles = ['' for i in range(len(divs))]
            image_urls = ['' for i in range(len(divs))]
            page_urls = ['' for i in range(len(divs))]
            descriptions = ['' for i in range(len(divs))]
            replies = ['' for i in range(len(divs))]
            locations = ['' for i in range(len(divs))]
            whatsapps = ['' for i in range(len(divs))]
            usernames = ['' for i in range(len(divs))]
            updated_at = ['' for i in range(len(divs))]
            created_dates = ['' for i in range(len(divs))]

            latest_num = get_latest_posts(query, divs)
            with concurrent.futures.ThreadPoolExecutor() as executor:
                futures = [executor.submit(scraper_helper, i, divs, post_titles, image_urls, page_urls, descriptions, replies, locations, usernames, created_dates, updated_at) for i in range(len(divs[:latest_num]))]
                concurrent.futures.wait(futures)
        else:
            print("No div with id='postsList' found.")
        

        """html_table = '''
        <p>{}</p>
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable">
                <thead>
                    <tr>
                        <th>Favourite</th>
                        <th>Post Title</th>
                        <th>Image URL</th>
                        <th>Page URL</th>
                        <th>Description</th>
                        <th>Replies</th>
                        <th>Location</th>
                        <th>Whatsapp</th>
                        <th>Username</th>
                        <th>Updated At</th>
                        <th>Post Time</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
        '''.format((str(len(post_titles)) + " number of rows."))"""

        print(len(post_titles))
        print(len(image_urls))
        print(len(page_urls))
        print(len(descriptions))
        print(len(replies))
        print(len(locations))
        print(len(usernames))
        print(len(created_dates))

        """for i in range(len(post_titles)):
            html_table += '''
            <tr data-row-id={}>
                <td><button class="favourite-btn">Favourite</button></td>
                <td id="post-title">{}</td>
                <td><img src={}></td>
                <td><a href={} target="_blank"><button>URL</button></a></td>
                <td>{}</td>
                <td>{}</td>
                <td data-class="location">{}</td>
                <td>{}</td>
                <td>{}</td>
                <td>{}</td>
                <td>{}</td>
                <td data-class="created-date">{}</td>
            </tr>
            '''.format(i, post_titles[i], image_urls[i], page_urls[i], descriptions[i], replies[i], locations[i], "Whatsapp", usernames[i], updated_at[i], "Post Time", created_dates[i])

        # Close the table and div tags
        html_table += '''
                </tbody>
            </table>
        </div>
        '''"""

        driver.quit()

        #drop empty rows
        for i in range(len(post_titles) - 1, -1, -1):
            if post_titles[i] == '' and usernames[i] == '' and created_dates[i] == '':
                del post_titles[i]
                del image_urls[i]
                del page_urls[i]
                del descriptions[i]
                del replies[i]
                del locations[i]
                del whatsapps[i]
                del usernames[i]
                del updated_at[i]
                del created_dates[i]

        if (len(post_titles) > 0):
            create_new_search(query, post_titles, image_urls, page_urls, descriptions, replies, locations, usernames, updated_at, created_dates)
            return ({"post_titles" : post_titles, "image_urls" : image_urls, "page_urls" : page_urls, "descriptions" : descriptions, "replies" : str(replies), "locations" : locations, 
                     "usernames" : usernames, "updated_at" : updated_at, "created_dates" : created_dates})
        else:
            return ({"post_titles" : ['post_titles'], "image_urls" : ['image_urls'], "page_urls" : ['page_urls'], "descriptions" : ['descriptions'], "replies" : ['str(replies)'], "locations" : ['locations'], 
                     "usernames" : ['usernames'], "updated_at" : ['updated_at'], "created_dates" : ['created_dates']})
    
    except Exception as e:
        exc_type, exc_obj, exc_tb = sys.exc_info()
        print(e, exc_tb.tb_lineno)

    

if __name__ == '__main__':
    app.run(debug=True)