<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\StoreRequest;
use App\Models\Link;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        return response()->json(Link::where('user_id', auth()->user()->id)->paginate());
    }

    public function show(Request $request)
    {
        $link = Link::find($request->link);
        if(!$link || $link->user_id != auth()->user()->id){
            return $this->notFound(null, 'Não foi possível encontrar esse link');
        }
        return $this->success($link, 'Sucesso ao encontrar o link');
    }

    public function store(StoreRequest $request)
    {
        $slug = $request->get('slug');

        if($slug && Link::where('slug', $slug)->first()){
            return $this->forbidden(null, 'Esse slug já está sendo utilizado');
        }

        $link = Link::create([
            'slug' => $slug ?? $this->generateCode(random_int(6, 8)),
            'user_id' =>  auth()->user()->id,
            'url' => $request->url,
        ]);

        return $this->create($link, 'Gerado novo link');
    }

    public function update(Request $request)
    {
        $slug = $request->get('slug');
        $url = $request->get('url');
        $data = [];

        if($slug){
            if(Link::where('slug', $slug)->first()){
                return $this->forbidden(null, 'Esse slug já está sendo utilizado');
            }
            $data['slug'] = $slug;
        }
        if($url){
            $data['url'] = $url;
        }

        $link = Link::find($request->link);
        if(!$link || $link->user_id != auth()->user()->id){
            return $this->notFound(null, 'Não foi possível encontrar esse link');
        }

        $link->update($data);

        return $this->success($link, 'Sucesso ao atualizar o link');
    }

    public function destroy(Request $request)
    {
        $link = Link::find($request->link);
        if(!$link || $link->user_id != auth()->user()->id){
            return $this->notFound(null, 'Não foi possível encontrar esse link');
        }
        $link->delete();

        return response()->noContent();
    }

    private function generateCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
