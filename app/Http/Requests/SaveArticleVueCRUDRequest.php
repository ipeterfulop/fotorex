<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ArticleVueCRUDFormdatabuilder;
use App\Article;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

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
            $subject = Article::create($this-getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(Article::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
