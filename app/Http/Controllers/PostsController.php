<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:8000/posts";
        $response = $client->request('GET',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];
       return view('posts.index',['data'=>$data]);
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        
        $parameter = [
            'title'=>$title,
            'content'=>$content
            
        ];

        $client = new Client();
        $url = "http://localhost:8000/posts";
        $response = $client->request('POST',$url, [
            'headers'=>['Content-type'=>'application/json'],
            'body'=>json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
       if($contentArray['status'] != true){
        $error = $contentArray['message'];
        return redirect()->to('posts')->withErrors($error);
       }else{
        echo "Sukses";
       }
    }

    public function edit(string $id)
    {
         
        $client = new Client();
        $url = "http://localhost:8000/posts/$id";
        $response = $client->request('GET',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if($contentArray['status']!=true){
            $error = $contentArray['message'];
            return redirect()->to('posts')->withErrors($error);
        }else{
            $data = $contentArray['message'];
            return view('posts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, string $id)
    { 
        $title = $request->title;
        $content = $request->content;

        $parameter = [
            'title'=>$title,
            'content'=>$content
        ];

        $client = new Client();
        $url = "http://localhost:8000/posts/$id";
        $response = $client->request('PUT',$url, [
            'headers'=>['Content-type'=>'application/json'],
            'body'=>json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
       if($contentArray['status'] != true){
        $error = $contentArray['message'];
        return redirect()->to('posts')->withErrors($error)->withInput();
       }else{
        return redirect()->to('posts')->with('success', 'Berhasil melakukan update data');
       }
    }

    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://localhost:8000/posts/$id";
        $response = $client->request('DELETE',$url);
    
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
       if($contentArray['status'] != true){
        $error = $contentArray['message'];
        return redirect()->to('posts')->withErrors($error)->withInput();
       }else{
        return redirect()->to('posts')->with('success', 'Berhasil melakukan hapus data');
       }
    }


}