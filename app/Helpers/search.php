<?php

if (!function_exists('prepare_keyword')) {
    /**
     *
     * @param $keyword
     * @return array
     */
    function prepare_keyword($keyword)
    {
        $keyword = trim($keyword);
        $keyword = Illuminate\Support\Str::lower($keyword);
        $keyword = preg_replace('/\s+/', ' ', $keyword);
        $keywords = array_unique(explode(' ', $keyword));
        $keywords = array_filter($keywords, 'strlen');
        return $keywords;
    }
}
