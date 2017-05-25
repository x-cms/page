<?php

namespace Xcms\Page\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function getTemplateAttribute($template)
    {
        return config('template.pages.' . $template);
    }
}
