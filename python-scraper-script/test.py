from selenium import webdriver
from concurrent.futures import ThreadPoolExecutor
import time

def open_google_page():
    # Path to your WebDriver, e.g., chromedriver for Chrome
    op = webdriver.ChromeOptions()
    op.add_argument("window-size=1920,1080")
    op.add_argument('--ignore-certificate-errors')
    op.add_argument('--ignore-ssl-errors')
    op.add_argument('--disable-extensions')
    op.add_experimental_option("excludeSwitches", ["enable-automation"])
    op.add_experimental_option('useAutomationExtension', False)
    op.binary_location = r"C:\Program Files\Google\Chrome\Application\chrome.exe"
    op.add_argument("webdriver.chrome.driver=C:\\Program Files\\chromedriver-win64\\chromedriver-win64\\chromedriver.exe")
    driver = webdriver.Chrome(options=op)
    driver.get("https://www.google.com")
    time.sleep(2)  # Keep the browser open for 10 seconds
    driver.quit()

if __name__ == "__main__":
    # Number of instances you want to open
    num_instances = 1
    
    with ThreadPoolExecutor(max_workers=num_instances) as executor:
        futures = [executor.submit(open_google_page) for _ in range(num_instances)]

    # Optionally, wait for all futures to complete
    for future in futures:
        future.result()