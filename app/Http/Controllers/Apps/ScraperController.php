<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersAssignedRoleDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ScheduledSearch;
use App\Models\SearchEntry;
use App\Models\Customer;
use Exception;
use Symfony\Component\HttpFoundation\StreamedResponse;
use simplehtmldom\HtmlDocument;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use Mockery\CountValidator\Exact;
use Illuminate\Support\Facades\Schema;

class ScraperController extends Controller
{
    public function index()
    {
        return view('pages/apps.scraper.index');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();

        if ($customer && $customer->subscription) {

            $currentMonthSearchesCount = $customer->searches()
            ->whereYear('created_at', '=', now()->year)
            ->whereMonth('created_at', '=', now()->month)
            ->count();

            $quota = 0;

            if ($customer->subscription == 'Beginner') {
                $quota = config('quotas.quota1');
            }
            elseif (($customer->subscription == 'Intermediate')) {
                $quota = config('quotas.quota2');
            }

            if ($currentMonthSearchesCount < $quota or $customer->subscription == "Advanced") {
                if (Schema::hasTable($query)) {
                    $data = DB::table($query)->get();
                    $post_titles = $data->pluck('post_title');
                    $image_urls = $data->pluck('image_url');
                    $usernames = $data->pluck('username');
                    $locations = $data->pluck('location');
                    $updated_at = $data->pluck('updated_at');
                    $page_urls = $data->pluck('page_url');
                    $descriptions = $data->pluck('description');
                    $created_dates = $data->pluck('created_date');
                    $replies = $data->pluck('reply');

                    $numRows = count($post_titles);
                    $htmlContentNew = $this->runPythonScript($query, $numRows);
                    $htmlContent =  $htmlContentNew . view('pages.apps.scraper.scrape-item.items2', compact('post_titles', 'image_urls', 'page_urls', 'descriptions', 'replies', 'locations', 'usernames', 'created_dates', 'updated_at'))->render();

                } else {
                    $htmlContent = $this->runPythonScript($query, 0);
                    //$htmlContent = $this->fetchHtmlFromScrapdogApi($query);
                    //$htmlContent = $this->fetchHtmlFromScrapflyApi($query);
                }
                if (!empty($htmlContent)) {
                    $customer->searches()->create([
                        'query' => $query
                    ]);
                    return view('pages.apps.scraper.result', ['htmlContent' => $htmlContent]);
                }
                else {
                    return $this->history();
                }
            }
            else {
            // Return a message indicating the quota has been exceeded
            return back()->with('error', 'Search quota exceeded for this month.');
            }
        } else {
            // Return a message indicating no subscription or customer found
            return back()->with('error', 'No subscription found for this user.');
        }
    }

    /*public function scheduledSearch(Request $request)
    {
        $query = $request->input('query');
        $sched_id = $request->input('sched_id');

        $htmlContent = $this->runPythonScript($query);

        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();
        if ($customer) {
            $customer->searches()->create([
                'query' => $query,
                'html' => $htmlContent
            ]);
        }

        ScheduledSearch::where('id', $sched_id)->delete();
    }*/

    public function history()
    {
        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();
        if ($customer) {
            $searches = $customer->searches;
            return view('pages/apps.scraper.history', ['searches' => $searches]);
        }
        return redirect()->route('dashboard')->with('error', 'You are not a customer');
    }

    public function exportToExcel(Request $request)
    {
        $htmlContent = $request->input('htmlContent');
        
        // Parse the HTML content using simplehtmldom
        $html = new HtmlDocument();
        $html->load($htmlContent);
        
        $response = new StreamedResponse(function() use ($html) {
            $handle = fopen('php://output', 'w');
    
            foreach ($html->find('tr') as $element) {
                $row = array();

                // Handle table headers
                foreach ($element->find('th') as $header) {
                    $row[] = $header->plaintext;
                }

                // Handle table data
                foreach ($element->find('td') as $data) {
                    $row[] = $data->plaintext;
                }

                fputcsv($handle, $row);
            }
    
            fclose($handle);
        });
    
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
    
        return $response;
    }

    public function showDetails($id)
    {
        $htmlContent = '';

        $search = SearchEntry::findOrFail($id);
        $query = $search->query;

        if (Schema::hasTable($query)) {
            $data = DB::table($query)->get();
            $post_titles = $data->pluck('post_title');
            $image_urls = $data->pluck('image_url');
            $usernames = $data->pluck('username');
            $locations = $data->pluck('location');
            $updated_at = $data->pluck('updated_at');
            $page_urls = $data->pluck('page_url');
            $descriptions = $data->pluck('description');
            $created_dates = $data->pluck('created_date');
            $replies = $data->pluck('reply');
            $totalRows = count($post_titles);
            
            $htmlContent =  view('pages.apps.scraper.scrape-item.items', compact('totalRows', 'post_titles', 'image_urls', 'page_urls', 'descriptions', 'replies', 'locations', 'usernames', 'created_dates', 'updated_at'))->render();
        }

        return view('pages.apps.scraper.result', ['htmlContent' => $htmlContent]);
    }

    private function fetchHtmlFromScrapflyApi($query) {
        // Create a new Guzzle HTTP client
        $client = new Client([
            'verify' => false,
        ]);

        // Define the API parameters
        $api_key = "scp-live-4777363a11e64d24bbaab823d50e2cd4";
        $url = "https://haraj.com.sa/";
        $render_js = "true";
        $asp = "true";
        $js_scenario = "W3siZXhlY3V0ZSI6eyJzY3JpcHQiOiJkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiYnV0dG9uW2RhdGEtdGVzdGlkPSdwb3N0cy1sb2FkLW1vcmUnXVwiKS5jbGljaygpIn19LHsiZXhlY3V0ZSI6eyJzY3JpcHQiOiJ3aW5kb3cuc2Nyb2xsQnkoMCwgZG9jdW1lbnQuYm9keS5zY3JvbGxIZWlnaHQpIn19LHsid2FpdCI6MTAwMH1d";

        $response = $client->request('GET', 'https://api.scrapfly.io/scrape', [
            'query' => [
                'key' => $api_key,
                'url' => $url,
                'render_js' => $render_js,
                'asp' => $asp,
                'js_scenario' => $js_scenario,
            ],
        ]);

        $body = $response->getBody()->getContents();
        $jsonResponse = json_decode($body, true);
        $html = $jsonResponse['result']['content'] ?? 'Content not found';
        return $html;
    }
    
    private function fetchHtmlFromScrapdogApi($query)
    {
        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);

        $encodedQuery = str_replace(' ', '%20', $query);

        // Construct the URL
        $baseUrl = "https://api.scrapingdog.com/scrape";
        $api_key = "665be6063187ef32369979f2";
        $url = "https://haraj.com.sa/search/" . $encodedQuery . "/";
        $dynamic = "false";

        // Make GET request
        $response = $client->request('GET', $baseUrl, [
            'query' => [
                'api_key' => $api_key,
                'url' => $url,
                'dynamic' => $dynamic,
            ],
        ]);

        // Initialize arrays to hold the extracted data
        $post_titles = [];
        $image_urls = [];
        $usernames = [];
        $locations = [];
        $updated_at = [];
        $page_urls = [];
        $descriptions = [];
        $created_dates = [];
        $replies = [];

        //get old html
        $old_html = DB::table('search_entries')
        ->select('html')
        ->where('query', $query)
        ->orderBy('created_at', 'desc')
        ->first();

        $latest_title = "";
        if ($old_html) {
            $old_html = $old_html->html;
            $old_html = (string) $old_html;
            $crawler = new Crawler($old_html);
            
            $latest_title_cell = $crawler->filter('#post-title');

            if ($latest_title_cell->count() > 0) {
                $latest_title = $latest_title_cell->text();
            }
        }

        $html = $response->getBody()->getContents();
        // Use DomCrawler to extract content of the div with id "postsList"
        $crawler = new Crawler($html);
        $postsListCrawler = $crawler->filter('#postsList');

        $postsListCrawler->filter('div[data-testid="post-item"]')->each(function (Crawler $node) use (&$old_html, &$post_titles, &$latest_title, &$image_urls, &$usernames, &$locations, &$updated_at, &$page_urls, &$descriptions, &$created_dates, &$replies, $client) {
            $a_tag = $node->filter('a[data-testid="post-title-link"]');
            $img_tag = $node->filter('div[data-testid="post-thumbnail"] img');
            $username_tag = $node->filter('a[data-testid="post-author_username"]');
            $updated_tag = $node->filter('span[dir="rtl"]');
            $city_tag = $node->filter('a[href*="city"]');

            if ($a_tag->count() && $img_tag->count() && $username_tag->count() && $city_tag->count()) {
                $post_titles[] = $a_tag->text();

                if ($a_tag->text() == $latest_title) {
                    $html_return = view('pages.apps.scraper.scrape-item.items-old', compact('post_titles', 'image_urls', 'page_urls', 'descriptions', 'replies', 'locations', 'usernames', 'created_dates', 'updated_at', 'old_html'))->render();
                    return $html_return;
                }

                $image_urls[] = explode(',', $img_tag->attr('srcset'))[0];
                $usernames[] = $username_tag->text();
                $locations[] = $city_tag->text();
                $updated_at[] = $updated_tag->text();

                $href = $a_tag->attr('href');
                $page_response = $client->request('GET', 'https://haraj.com.sa/' . $href . '/');
                $page_html = $page_response->getBody()->getContents();
                $crawler = new Crawler($page_html);
                $page_urls[] = $href . '/';

                $post_article = $crawler->filter('[data-testid="post-article"]');

                if ($post_article->count()) {
                    $descriptions[] = $post_article->text();

                    // Extract date from img srcset attribute
                    $img_tags = $crawler->filter('img');
                    $total_images = $img_tags->count();
                    for ($i = 0; $i < $total_images; $i++) {
                        $img = $img_tags->eq($i); // Get the image element at index $i
                        $srcset = $img->attr('srcset'); // Get the 'srcset' attribute
                    
                        if ($srcset) {
                            // Split the URL to get the parts
                            $url_parts = explode('/', $srcset);
                            if (isset($url_parts[4])) {
                                $created_dates[] = $url_parts[4];
                            }
                        }
                    }

                    // Extract comments
                    $comment_divs = $crawler->filter("[data-testid='post-comments-list'] div")->slice(0, 3);
                    $replies[] = $comment_divs->each(function (Crawler $comment) {
                        return $comment->text();
                    });
                    foreach ($replies as &$reply) {
                        $reply = is_array($reply) ? $reply : [$reply];
                    }
                    unset($reply);

                } else {
                    $page_urls[] = '';
                    $descriptions[] = '';
                    $created_dates[] = '';
                    $replies[] = '';
                }
            }
        });

        $html_return = view('pages.apps.scraper.scrape-item.items', compact('post_titles', 'image_urls', 'page_urls', 'descriptions', 'replies', 'locations', 'usernames', 'created_dates', 'updated_at'))->render();
        return $html_return;
    }

    private function runPythonScript($query, $numRows)
    {
        ini_set('max_execution_time', 360);

        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);

        // Make POST request
        $response = $client->request('POST', 'http://77.37.54.26:5000/scrape', [
            'form_params' => [
                'query' => $query
            ]
        ]);

        $body = $response->getBody()->getContents();
        $jsonResponse = json_decode($body, true);
        $post_titles = $jsonResponse['post_titles'];
        $image_urls = $jsonResponse["image_urls"];
        $usernames = $jsonResponse["usernames"];
        $locations = $jsonResponse["locations"];
        $updated_at = $jsonResponse["updated_at"];
        $page_urls = $jsonResponse["page_urls"];
        $descriptions = $jsonResponse["descriptions"];
        $created_dates = $jsonResponse["created_dates"];
        $replies = $jsonResponse["replies"];

        if ($post_titles[0] == 'post_titles') {
            $post_titles = [];
            $image_urls = [];
            $usernames = [];
            $locations = [];
            $updated_at = [];
            $page_urls = [];
            $descriptions = [];
            $created_dates = [];
            $replies = [];
        }
        $totalRows = count($post_titles) + $numRows;

        $html_return = view('pages.apps.scraper.scrape-item.items', compact('totalRows', 'post_titles', 'image_urls', 'page_urls', 'descriptions', 'replies', 'locations', 'usernames', 'created_dates', 'updated_at'))->render();
        
        return $html_return;
    }
}