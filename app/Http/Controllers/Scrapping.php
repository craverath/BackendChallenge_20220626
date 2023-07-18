<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Scrapping extends Controller
{
    private $httpClient;
      

    public function __construct()
    {
        $this->httpClient = new Client(['verify' => false]);  
        set_time_limit(1200);      
    }

    public function scraplinks()
    {
        $response = $this->httpClient->request('GET', 'https://world.openfoodfacts.org/');
        $html = $response->getBody();

        $crawler = new Crawler($html);
       
        $elementosProdutos = $crawler->filter('ul.products li a')
            ->each(function (Crawler $node, $i) {
                return $node->attr('href');
            });

        $linkArray = array();
        foreach ($elementosProdutos as $elementos) {

            $linkArray[] = "https://openfoodfacts.org/" . $elementos;
        }
        return $linkArray;
    }

    public function scrapproducts()
    {
        $linkArray= $this->scraplinks();
        
        For($i=0; $i<10; $i++){
            
           
            
            $arrayProdutos['url'] = $linkArray[$i];

            $requestHtmlProduto = $this->httpClient->request('GET', $linkArray[$i]);
            $htmlProduto = $requestHtmlProduto->getBody();
            $crawler = new Crawler($htmlProduto);
        
            $nomeProduto = $crawler->filter('h2.title-1')->text();

            $nomeProdutoLimpo = substr($nomeProduto, 0, strpos($nomeProduto, '-'));
            $nomeProdutoLimpo = trim($nomeProdutoLimpo);
            $arrayProdutos['product_name'] = $nomeProdutoLimpo;

        
            $barcode = $crawler->filter('span#barcode')->count() > 0 ? $crawler->filter('span#barcode')->text() : 0;
            $arrayProdutos['code'] = (int) $barcode;
            $barcode = 0 ? "Empty value" :  $barcode . "(EAN / EAN-13)";
            $arrayProdutos['barcode'] = $barcode;
        
        
            $produtoQuantidade = $crawler->filter('span#field_quantity_value')->count() > 0 ? $crawler->filter('span#field_quantity_value')->text() : "Empty value";
            $arrayProdutos['quantity'] = $produtoQuantidade;
        
            $categories =$crawler->filter('span#field_categories_value')->count() > 0 ? $crawler->filter('span#field_categories_value')->text() : "Empty value";
            $arrayProdutos['categories'] = $categories;
        
            $packaging = $crawler->filter('span#field_packaging_value')->count() > 0 ? $crawler->filter('span#field_packaging_value')->text() : "Empty value";
            $arrayProdutos['packaging'] = $packaging;
        
            $brand = $crawler->filter('span#field_brands_value')->count() > 0 ? $crawler->filter('span#field_brands_value')->text() : "Empty value";
            $arrayProdutos['brands'] = $brand;
        
            $img = $crawler->filter('img#og_image')->count() > 0 ? $crawler->filter('img#og_image')->attr('src') : "Empty value";
            $arrayProdutos['image_url'] = $img;
        
        
             $arrayProdutosTotal[] = $arrayProdutos; 
            
           }
           return $arrayProdutosTotal;


    }
}
