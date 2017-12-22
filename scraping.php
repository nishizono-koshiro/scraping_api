<?php
// PHP Simple HTML DOM Parser
require_once('./simple_html_dom.php');

$url = 'https://www.google.co.jp/search?q=%E6%B2%96%E7%B8%84%E3%80%80%E9%AB%98%E7%B4%9A%E3%83%9B%E3%83%86%E3%83%AB';

$html = file_get_html($url);
mb_language('Japanese');
$contents = file_get_contents($url);
$content = mb_convert_encoding($contents, 'UTF-8', 'auto');
$html = str_get_html($content);

foreach ($html->find('.r a') as $list) {
    echo "<<< " . title_name($list->outertext) . " >>>" . "\n";
    echo link_name($list->outertext) . "\n";
}

$html->clear();
unset($html);

// タイトル抽出
function title_name($string) {
    $str = explode('">', $string);
    return strip_tags($str[1]);
}

// リンク抽出
function link_name($string) {
    $str_1 = explode('url?q=', $string);
    $str_2 = $str_1[1];
    $str_3 = explode('&amp;', $str_2);
    return strip_tags($str_3[0]);
}
