<?php

namespace App\Models;


class RepoPage
{

    public $size = '';
    public $forks = '';
    public $stars = '';
    public $followers = '';
    public $page = '1';
    public $paging;
    public $countResult;
    public $repositories;

    function __construct(string $jSonString)
    {
        $arr = json_decode($jSonString);

        foreach ($arr as $obj) {
            //var_dump($obj->field);
            $this->size = ($obj->field == 'size') ? '+size:' . $obj->operator . $obj->value : $this->size;
            $this->forks = ($obj->field == 'forks') ? '+forks:' . $obj->operator . $obj->value : $this->forks;
            $this->stars = ($obj->field == 'stars') ? '+stars:' . $obj->operator . $obj->value : $this->stars;
            $this->followers = ($obj->field == 'followers') ? '+followers:' . $obj->operator . $obj->value : $this->followers;
            $this->page = ($obj->field == 'page') ? '&page=' . $obj->value : $this->page;
        }
    }

    public function getArrRepos()
    {
        //$url = 'https://api.github.com/search/repositories?q=all+stars:>=5+size:>=10000+forks:>=5&sort=stars&order=desc';
        $url = 'https://api.github.com/search/repositories?q=all' .
            $this->stars .
            $this->forks .
            $this->size .
            '&sort=stars&order=desc' .
            $this->page;

        $headers = array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2) Gecko/20100115 Firefox/3.6',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8', 'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
            'Accept-Encoding: deflate', 'Accept-Charset: windows-1251;q=0.7,*;q=0.7');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $page = curl_exec($ch);
        $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($page, 0, $header_len);
        $body = substr($page, $header_len);
        curl_close($ch);

        preg_match('/<http[^>]+page=(\d{1,20})>; rel="first"/U', $header, $matches);
        $this->paging['firstPage'] = (isset($matches[1])) ? $matches[1] : NULL;
        preg_match('/<http[^>]+page=(\d{1,20})>; rel="prev"/U', $header, $matches);
        $this->paging['prevPage'] = (isset($matches[1])) ? $matches[1] : NULL;
        preg_match('/<http[^>]+page=(\d{1,20})>; rel="next"/U', $header, $matches);
        $this->paging['nextPage'] = (isset($matches[1])) ? $matches[1] : NULL;
        preg_match('/<http[^>]+page=(\d{1,20})>; rel="last"/U', $header, $matches);
        $this->paging['lastPage'] = (isset($matches[1])) ? $matches[1] : NULL;

        $body = json_decode($body);

        $this->countResult = $body->total_count;

        foreach ($body->items as $key => $item) {
            $this->repositories[$key] = new Repository(
                $item->name,
                $item->html_url,
                $item->size,
                $item->forks,
                $item->stargazers_count);
        }
        return $this;
    }
}
