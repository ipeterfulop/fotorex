<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ArticleVueCRUDFormdatabuilder;
use App\Article;
use App\Oldslug;
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
            $subject = Article::create($this->getDataset($subject));
        } else {
            $this->storeSlugIfChanged($subject);
            $subject->update($this->getDataset($subject));
        }

        return $subject;
    }

    public function getDataset($subject)
    {
        $result = [
            'title' => $this->input('title'),
            'content' => $this->input('content'),
            'summary' => $this->input('summary'),
            'index_image' => basename($this->input('index_image')),
            'is_published' => $this->input('is_published'),
            'articlecategory_id' => intval($this->input('articlecategory_id')) > 0 ? $this->input('articlecategory_id') : null,
            'slug' => $this->input('slug'),
        ];
        if ($subject == null) {
            $result['published_at'] = now();
        }
        if (($subject != null) && ($subject->published_at->format('Y-m-d') != $this->input('published_at'))) {
            $result['published_at'] = Carbon::parse($this->input('published_at'));
        }
        return $this->addPositionToDatasetIfNecessary($subject, Article::class, $result);
    }

    protected function storeSlugIfChanged($article)
    {
        if ($this->input('slug') != $article->slug) {
            Oldslug::updateOrCreate([
                'slug' => $article->slug,
                'redirect_to' => $article->id
            ]);
        }
    }
}
