<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.1
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: searchenginelist.php
//----------------------------------------------------------------------
//file base on SearchEngines.php file of phpMyVisites V2
/*
 * phpMyVisites : website statistics and audience measurements
 * Copyright (C) 2002 - 2006
 * http://www.phpmyvisites.net/
 * phpMyVisites is free software (license GNU/GPL)
 * Authors : phpMyVisites team and community
*/
//----------------------------------------------------------------------
//  Last update: 05/11/2011
//----------------------------------------------------------------------
$crawltcssaattack = array("http:", "ftp:", "https:", "http%3a", "https%3a", "ht%20tp:", "htt%20p:", "http%20:", "h%20ttp:", "/etc/passwd", "ShellAdresi.TXT", "[evil_root]?", "http%3A%2F%2F","%68%74%74%70%3a","%68%74%74%70%73%3a","%48%54%54%50%3a","%48%54%54%50%53%3a","%3C?");
$crawltsqlaattack = array("%20select%20", "%20like%20", "%20or%20", "%20where%20","%20SELECT%20", "%20LIKE%20", "%20OR%20", "%20WHERE%20");
$crawltgooglelist = array(
"www.google.fr",
"www.google.ad",
"www.google.ae",
"www.google.am",
"www.google.as",
"www.google.at",
"www.google.az",
"www.google.be",
"www.google.bg",
"www.google.bf",
"www.google.ba",
"www.google.bi",
"www.google.bj",
"www.google.bs",
"www.google.ca",
"www.google.cat",
"www.google.cc",
"www.google.cd",
"www.google.cf",
"www.google.cg",
"www.google.ch",
"www.google.ci",
"www.google.cl",
"www.google.cm",
"www.google.cn",
"www.google.co",
"www.google.cz",
"www.google.de",
"www.google.dj",
"www.google.dk",
"www.google.dm",
"www.google.dz",
"www.google.ee",
"www.google.es",
"www.google.fi",
"www.google.fm",
"www.google.gg",
"www.google.ge",
"www.google.gl",
"www.google.gm",
"www.google.gp",
"www.google.gr",
"www.google.hn",
"www.google.hr",
"www.google.ht",
"www.google.hu",
"www.google.ie",
"www.google.im",
"www.google.iq",
"www.google.is",
"www.google.it",
"www.google.jo",
"www.google.kz",
"www.google.kq",
"www.google.la",
"www.google.li",
"www.google.lk",
"www.google.lt",
"www.google.lu",
"www.google.lv",
"www.google.me",
"www.google.mg",
"www.google.ml",
"www.google.mn",
"www.google.ms",
"www.google.mu",
"www.google.mv",
"www.google.mw",
"www.google.md",
"www.google.ne",
"www.google.nl",
"www.google.no",
"www.google.pl",
"www.google.sk",
"www.google.pn",
"www.google.ps",
"www.google.pt",
"www.google.dk",
"www.google.ro",
"www.google.rs",
"www.google.ru",
"www.google.rw",
"www.google.se",
"www.google.sh",
"www.google.si",
"www.google.sm",
"www.google.sn",
"www.google.so",
"www.google.td",
"www.google.tk",
"www.google.tn",
"www.google.to",
"www.google.tp",
"www.google.tq",
"www.google.tt",
"www.google.uz",
"www.google.vg",
"www.google.vu",
"www.google.ws",
"www.google.com.af",
"www.google.com.ag",
"www.google.com.ai",
"www.google.com.ar",
"www.google.com.au",
"www.google.com.bd",
"www.google.com.bh",
"www.google.com.bn",
"www.google.com.bo",
"www.google.com.br",
"www.google.com.by",
"www.google.com.bz",
"www.google.com.co",
"www.google.com.cu",
"www.google.com.ec",
"www.google.com.eg",
"www.google.com.et",
"www.google.com.do",
"www.google.com.fj",
"www.google.com.gh",
"www.google.com.gr",
"www.google.com.gt",
"www.google.com.hk",
"www.google.com.jm",
"www.google.com.kh",
"www.google.com.kw",
"www.google.com.lb",
"www.google.com.ly",
"www.google.com.mt",
"www.google.com.mx",
"www.google.com.my",
"www.google.com.na",
"www.google.com.nf",
"www.google.com.ng",
"www.google.com.ni",
"www.google.com.np",
"www.google.com.pa",
"www.google.com.pe",
"www.google.com.ph",
"www.google.com.pk",
"www.google.com.pl",
"www.google.com.pr",
"www.google.com.py",
"www.google.com.qa",
"www.google.com.qi",
"www.google.com.om",
"www.google.com.ru",
"www.google.com.sg",
"www.google.com.sa",
"www.google.com.sb",
"www.google.com.sv",
"www.google.com.tn",
"www.google.com.tr",
"www.google.com.tw",
"www.google.com.ua",
"www.google.com.uy",
"www.google.com.vc",
"www.google.com.vn",
"www.google.co.bw",
"www.google.co.ck",
"www.google.co.cr",
"www.google.co.gg",
"www.google.co.hu",
"www.google.co.id",
"www.google.co.il",
"www.google.co.in",
"www.google.co.je",
"www.google.co.jp",
"www.google.co.ls",
"www.google.co.ke",
"www.google.co.kr",
"www.google.co.mz",
"www.google.co.nz",
"www.google.co.th",
"www.google.co.tz",
"www.google.co.ug",
"www.google.co.uk",
"www.google.co.uq",
"www.google.co.uz",
"www.google.co.ve",
"www.google.co.vi",
"www.google.co.yu",
"www.google.co.za",
"www.google.co.ma",
"www.google.co.zm",
"www.google.co.zw",
"www.google.com",
"images.google.com",
"images.google.fr",
"images.google.ad",
"images.google.ae",
"images.google.am",
"images.google.as",
"images.google.at",
"images.google.az",
"images.google.be",
"images.google.bg",
"images.google.bf",
"images.google.ba",
"images.google.bi",
"images.google.bj",
"images.google.bs",
"images.google.ca",
"images.google.cat",
"images.google.cc",
"images.google.cd",
"images.google.cf",
"images.google.cg",
"images.google.ch",
"images.google.ci",
"images.google.cl",
"images.google.cm",
"images.google.cn",
"images.google.co",
"images.google.cz",
"images.google.de",
"images.google.dj",
"images.google.dk",
"images.google.dm",
"images.google.dz",
"images.google.ee",
"images.google.es",
"images.google.fi",
"images.google.fm",
"images.google.gg",
"images.google.ge",
"images.google.gl",
"images.google.gm",
"images.google.gp",
"images.google.gr",
"images.google.hn",
"images.google.hr",
"images.google.ht",
"images.google.hu",
"images.google.ie",
"images.google.im",
"images.google.iq",
"images.google.is",
"images.google.it",
"images.google.jo",
"images.google.kz",
"images.google.kq",
"images.google.la",
"images.google.li",
"images.google.lk",
"images.google.lt",
"images.google.lu",
"images.google.lv",
"images.google.me",
"images.google.mg",
"images.google.ml",
"images.google.mn",
"images.google.ms",
"images.google.mu",
"images.google.mv",
"images.google.mw",
"images.google.md",
"images.google.ne",
"images.google.nl",
"images.google.no",
"images.google.pl",
"images.google.sk",
"images.google.pn",
"images.google.ps",
"images.google.pt",
"images.google.dk",
"images.google.ro",
"images.google.rs",
"images.google.ru",
"images.google.rw",
"images.google.se",
"images.google.sh",
"images.google.si",
"images.google.sm",
"images.google.sn",
"images.google.so",
"images.google.td",
"images.google.tk",
"images.google.tn",
"images.google.to",
"images.google.tp",
"images.google.tq",
"images.google.tt",
"images.google.uz",
"images.google.vg",
"images.google.vu",
"images.google.ws",
"images.google.com.af",
"images.google.com.ag",
"images.google.com.ai",
"images.google.com.ar",
"images.google.com.au",
"images.google.com.bd",
"images.google.com.bh",
"images.google.com.bn",
"images.google.com.bo",
"images.google.com.br",
"images.google.com.by",
"images.google.com.bz",
"images.google.com.co",
"images.google.com.cu",
"images.google.com.ec",
"images.google.com.eg",
"images.google.com.et",
"images.google.com.do",
"images.google.com.fj",
"images.google.com.gh",
"images.google.com.gr",
"images.google.com.gt",
"images.google.com.hk",
"images.google.com.jm",
"images.google.com.kh",
"images.google.com.kw",
"images.google.com.lb",
"images.google.com.ly",
"images.google.com.mt",
"images.google.com.mx",
"images.google.com.my",
"images.google.com.na",
"images.google.com.nf",
"images.google.com.ng",
"images.google.com.ni",
"images.google.com.np",
"images.google.com.pa",
"images.google.com.pe",
"images.google.com.ph",
"images.google.com.pk",
"images.google.com.pl",
"images.google.com.pr",
"images.google.com.py",
"images.google.com.qa",
"images.google.com.qi",
"images.google.com.om",
"images.google.com.ru",
"images.google.com.sg",
"images.google.com.sa",
"images.google.com.sb",
"images.google.com.sv",
"images.google.com.tn",
"images.google.com.tr",
"images.google.com.tw",
"images.google.com.ua",
"images.google.com.uy",
"images.google.com.vc",
"images.google.com.vn",
"images.google.co.bw",
"images.google.co.ck",
"images.google.co.cr",
"images.google.co.gg",
"images.google.co.hu",
"images.google.co.id",
"images.google.co.il",
"images.google.co.in",
"images.google.co.je",
"images.google.co.jp",
"images.google.co.ls",
"images.google.co.ke",
"images.google.co.kr",
"images.google.co.mz",
"images.google.co.nz",
"images.google.co.th",
"images.google.co.tz",
"images.google.co.ug",
"images.google.co.uk",
"images.google.co.uq",
"images.google.co.uz",
"images.google.co.ve",
"images.google.co.vi",
"images.google.co.yu",
"images.google.co.za",
"images.google.co.ma",
"images.google.co.zm",
"images.google.co.zw",
);

$crawltmsnlist = array(
"www.live.com",
"beta.search.live.com",
"beta.search.msn.com",
"search.live.com",
"search.msn.fr",
"search.msn.es",
"search.msn.se",
"search.latam.msn.com",
"search.msn.nl",
"search.msn.co.jp",
"search.msn.no",
"search.msn.at",
"search.msn.com.hk",
"search.msn.com.ph",
"search.t1msn.com.mx",
"fr.ca.search.msn.com",
"search.msn.be",
"search.fr.msn.be",
"search.msn.it",
"search.msn.com.tw",
"search.msn.de",
"search.msn.co.uk",
"search.msn.co.za",
"search.msn.ch",
"search.msn.es",
"search.msn.com.br",
"search.ninemsn.com.au",
"search.msn.dk",
"search.arabia.msn.com",
"search.msn.com",
"search.prodigy.msn.com",
"search.msn.com.tr",
"search.msn.co.id",
"search.msn.com.sg",
"ie.search.msn.com",
"www.bing.com",
"cn.bing.com",
);

$crawltyahoolist = array(
"ink.yahoo.com",
"ink.yahoo.fr",
"fr.ink.yahoo.com",
"search.yahoo.co.jp",
"search.yahoo.fr",
"ar.search.yahoo.com",
"br.search.yahoo.com",
"de.search.yahoo.com",
"ca.search.yahoo.com",
"cf.search.yahoo.com",
"dk.search.yahoo.com",
"fr.search.yahoo.com",
"espanol.search.yahoo.com",
"es.search.yahoo.com",
"hk.search.yahoo.com",
"id.search.yahoo.com",
"in.search.yahoo.com",
"it.search.yahoo.com",
"kr.search.yahoo.com",
"mx.search.yahoo.com",
"nl.search.yahoo.com",
"uk.search.yahoo.com",
"cade.search.yahoo.com",
"tw.search.yahoo.com",
"vn.search.yahoo.com",
"www.yahoo.com.cn",
"search.yahoo.com",
"search.cn.yahoo.com",
"kr.dist.search.yahoo.com",
);

$crawltasklist = array(
"web.ask.com",
"www.ask.co.uk",
"au.ask.com",
"uk.ask.com",
"fr.ask.com",
"de.ask.com",
"es.ask.com",
"it.ask.com",
"nl.ask.com",
"ask.jp",
"www.ask.com",
);
//exalead list no more used in 3.2.0
$crawltexaleadlist = array(
"www.exalead.com",
"www.exalead.fr",
);

$crawltbaidulist = array(
"www.baidu.com",
);

$crawltbrowserlist = array(
//Chrome
"Chrome",
//Firefox
"Firefox",
//Internet explorer-windows 98
"compatible; MSIE 5.0; Windows 98;",
"compatible; MSIE 5.01; Windows 98;",
"compatible; MSIE 5.5; Windows 98;",
"compatible; MSIE 6.0; Windows 98;",
//Internet explorer-windows 2000
"compatible; MSIE 5.01; Windows NT 5.0;",
"compatible; MSIE 5.5; Windows NT 5.0;",
"compatible; MSIE 6.0; Windows NT 5.0;",
//Internet explorer-windows XP
"compatible; MSIE 6.0; Windows NT 5.1;",
"compatible; MSIE 7.0; Windows NT 5.1;",
"compatible; MSIE 8.0; Windows NT 5.1;",
//Internet explorer-windows Vista
"compatible; MSIE 7.0; Windows NT 6.0;",
"compatible; MSIE 8.0; Windows NT 5.2;",
"compatible; MSIE 8.0; Windows NT 6.0;",
"compatible; MSIE 9.0; Windows NT 6.0;",
//Internet explorer-windows Seven
"compatible; MSIE 7.0; Windows NT 6.1;",
"compatible; MSIE 8.0; Windows NT 6.1;",
"compatible; MSIE 9.0; Windows NT 6.1;",
//Internet explorer pocket
"compatible; MSIE 4.01; Windows CE;",
//PlayStation
"PlayStation Portable",
//others
"Opera",
"Safari",
"OmniWeb",
"BrowseX",
"MultiZilla",
"SeaMonkey",
"K-meleon",
"Camino",
"Konqueror",
);

$crawltbrowserlist2 = array(
"0" => "??",
//Chrome
"1" => "Chrome",
//Firefox
"2" => "Firefox",
//Internet explorer
"3" => "Internet Explorer 5",
"4" => "Internet Explorer 6",
"5" => "Internet Explorer 7",
"6" => "Internet Explorer 8",
//Internet explorer pocket
"7" => "Internet explorer pocket",
//PlayStation
"8" => "PlayStation Portable",
//others
"9" => "Opera",
"10" => "Safari",
"11" => "OmniWeb",
"12" => "BrowseX",
"13" => "MultiZilla",
"14" => "SeaMonkey",
"15" => "K-meleon",
"16" => "Camino",
"17" => "Konqueror",
"18" => "Safari iPhone",
"19" => "Safari iPod Touch",
"20" => "Safari Android",
"21" => "Safari Nokia",
"22" => "Opera Mini",
"23" => "Safari iPad",
"24" => "Internet Explorer 9",
);


$crawltnonebrowserlist = array(
"bsalsa.com",
"HTTrack",
"MemoWeb",
"AspiWeb",
"OutWit",
"Wget",
"cURL",
"Webcopier",
"AntivirXP08",
"Zango",
"Robot",
"iOpus",
"FunWebProducts",
"AMD64",
"Win64",
"Jakarta",
);

?>
