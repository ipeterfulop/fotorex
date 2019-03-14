<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ArticleVueCRUDFormdatabuilder;
use App\Article;
use App\Oldarticleslug;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;
use Illuminate\Support\Carbon;

class SaveArticleVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ArticleVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Article $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = Article::create($this->getDataset());
        } else {
            $this->storeSlugIfChanged($subject);
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = [
            'title' => $this->input('title'),
            'content' => $this->input('content'),
            'summary' => $this->input('summary'),
            'index_image' => $this->input('index_image'),
            'published_at' => Carbon::parse($this->input('published_at')),
            'slug' => $this->input('slug'),
        ];

        return $result;
    }

    protected function storeSlugIfChanged($article)
    {
        if ($this->input('slug') != $article->slug) {
            Oldarticleslug::updateOrCreate([
                'slug' => $article->slug,
                'article_id' => $article->id
            ]);
        }
    }
}
