<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class NewsController extends Controller
{
    public function scrape()
    {
        // Create a new Goutte client
        $client = new Client();

        // Specify the URL of the website you want to scrape
        $url = 'https://www.banglabarta.net';

        // Send a GET request to the website
        $crawler = $client->request('GET', $url);
//dd($crawler);
        // Extract the news articles using CSS selectors
        $articles = $crawler->filter('.content_type_article')->each(function ($node) {
            
            // Extract the title, description, and URL of each news article
            $title = $node->filter('.title')->text();
            $description = $node->filter('.title')->text();
            $url = $node->filter('.link_overlay')->attr('href');

            // Save the news article to your database or perform any other desired action
            // ...

            // Return the extracted data if needed
           
            return [
                'title' => $title,
                'description' => $description,
                'url' => $url,
            ];
        });
        dd($articles);

        // Return a response or redirect to another page
    }


     public function scrape_prothomalo()
     {
         $client = new Client();
     
         $url = 'https://www.prothomalo.com/collection/latest';
     
         $crawler = $client->request('GET', $url);
         dd($crawler);
         $articles = $crawler->filter('.left_image_right_news news_item wMFhj')->each(function ($node) {
             $title = $node->text();
             $url = $node->attr('href');
             return [
                 'title' => $title,
                 'url' => $url,
             ];
         });
     
         return response()->json($articles);
     }





}