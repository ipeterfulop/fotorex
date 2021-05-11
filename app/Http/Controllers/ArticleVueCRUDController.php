<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\ArticleVueCRUDFormdatabuilder;
use App\Http\Requests\SaveArticleVueCRUDRequest;
use App\Dataproviders\ArticleVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Article;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;
use Illuminate\Support\Str;

class ArticleVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Article::class;
    const SUBJECT_SLUG = 'article';
    const SUBJECT_NAME = 'Article';


    public function store(SaveArticleVueCRUDRequest $request)
    {
        $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return route($this->getRouteName('index'));
    }

    public function update(SaveArticleVueCRUDRequest $request, Article $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return route($this->getRouteName('index'));
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new ArticleVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

    protected function renderPreview()
    {
        $article = new Article();
        $article->title = 'Előnézet';
        $article->published_at = now();
        $article->content = request()->get('content');

        return view('public.articles.show', ['article' => $article, 'backUrl' => '#']);
    }

    public function storePublicPicture()
    {
        file_put_contents(
            public_path(Article::FILE_PUBLIC_PATH).DIRECTORY_SEPARATOR.request()->get('fileName'),
            base64_decode(Str::after(request()->get('fileData'), ';base64,'))
        );
        return response()->json(['url' => Article::FILE_PUBLIC_PATH.DIRECTORY_SEPARATOR.request()->get('fileName')]);
    }

    public function removePublicPicture()
    {
        return response('OK');
    }
}
