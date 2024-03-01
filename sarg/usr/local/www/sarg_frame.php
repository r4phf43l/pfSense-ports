<?php
/*
	sarg_frame.php
	part of pfSense (https://www.pfSense.org/)
 	Copyright (C) 2024 Rafael de Almeida Antonio <rafael.antonio@gmail.com>
	Copyright (C) 2012 Marcello Coutinho <marcellocoutinho@gmail.com>
	Copyright (C) 2015 ESF, LLC
	All rights reserved.

	Redistribution and use in source and binary forms, with or without
	modification, are permitted provided that the following conditions are met:

	1. Redistributions of source code must retain the above copyright notice,
	   this list of conditions and the following disclaimer.

	2. Redistributions in binary form must reproduce the above copyright
	   notice, this list of conditions and the following disclaimer in the
	   documentation and/or other materials provided with the distribution.

	THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
	INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
	AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
	AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
	OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
	SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
	INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
	CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
	ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
	POSSIBILITY OF SUCH DAMAGE.
*/
require_once("authgui.inc");

$uname = posix_uname();
if ($uname['machine'] == 'amd64') {
	ini_set('memory_limit', '768M');
}

// local file inclusion check
if(!empty($_REQUEST['file'])){
        $_REQUEST['file']=preg_replace('/(\.+\/|\\\.*|\/{2,})*/',"", $_REQUEST['file']);
}

if (preg_match("/(\S+)\W(\w+.html)/", $_REQUEST['file'], $matches)) {
	// URL format
	// https://192.168.1.1/sarg_reports.php?file=2012Mar30-2012Mar30/index.html
	$url = $matches[2];
	$prefix = $matches[1];
} else {
	$url = "index.html";
	$prefix = "";
}

$url = ($_REQUEST['file'] == "" ? "index.html" : $_REQUEST['file']);
$dir = "/usr/local/sarg-reports";
if ($_REQUEST['dir'] != "") {
    $dsuffix = preg_replace("/\W/", "", $_REQUEST['dir']);
    $dir .= "/" . $dsuffix;
} else {
    $dsuffix = "";
}
    
$rand = rand(100000000000, 999999999999);
$report = "";

if (file_exists("{$dir}/{$url}")) {
	$report = file_get_contents("{$dir}/{$url}");
} elseif (file_exists("{$dir}/{$url}.gz")) {
	$data = gzfile("{$dir}/{$url}.gz");
	$report = implode($data);
	unset ($data);
}
if ($report != "" ) {
$pattern[0] = '/href=\W(\S+html)\W/';$pattern[0] = '/href=\W(\S+html)\W/';
    $replace[0] = "href=/sarg_frame.php?dir=" . $dsuffix . "&prevent=" . $rand . "&file=$prefix/$1";
    $pattern[1] = '/<head>/';
    $replace[1] = '<head><META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"><META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">';
    $pattern[2] = '/img src="\S+\W([a-zA-Z0-9.-]+.png)/';
    $replace[2] = 'img src="/sarg-images/$1';
    $pattern[3] = '@img src="([.a-z/]+)/(\w+\.\w+)@';
    $replace[3] = 'img src="/sarg-images' . $prefix . '/$1/$2';
    $pattern[4] = '/img src="([a-zA-Z0-9.-_]+).png/';
    $replace[4] = 'img src="/sarg-images/temp/$1.' . $rand . '.png';
    $pattern[5] = '/tt.html/';
    $replace[5] = 'tt.html&';
//R4PHF4 Customs
    $pattern[6] = '/<div class=\"report\"><table cellpadding=\"1\" cellspacing=\"2\">/';
    $replace[6] = '<div class="buttons content print-group btn-group"><table cellpadding="1" cellspacing="2">';
    $pattern[7] = '/cellpadding=\"1\"/';
    $replace[7] = 'cellpadding="0"';
    $pattern[8] = '/<body>/';
    $replace[8] = '<link rel="stylesheet" href="/vendor/font-awesome/css/all.min.css?v=' . $rand . '"><link rel="stylesheet" href="/vendor/font-awesome/css/v4-shims.css?v=' . $rand . '"><link rel="stylesheet" href="/vendor/sortable/sortable-theme-bootstrap.css?v=' . $rand . '"><link rel="stylesheet" href="/css/pfSense.css?v=' . $rand . '"><script type="text/javascript" src="/sarg_print.js"></script><body>';
    $pattern[9] = '/header_[lc]/';
    $replace[9] = '';
    $pattern[10] = '/<\/thead>/';
    $replace[10] = '</thead><tbody id="leaselist">';
    $pattern[11] = '/<\/table>/';
    $replace[11] = '</tbody></table>';
    $pattern[12] = '/<td class=\"data[12]\"/';
    $replace[12] = '<td';  
    $pattern[13] = '/<style type=\"text\/css\">/';
    $replace[13] = '<!--<style type="text/css">';
    $pattern[14] = '/<\/style>/';
    $replace[14] = '</style>-->';
    $pattern[15] = '/<div class=\"report\"><table(\b(?![^>]*\bclass\b)[^>]*)>/';
    $replace[15] = '<div class="report"><table $1 class="report">';
    $pattern[17] = '/<table[^>]*class=\"(report|sortable)\"[^>]*>/';
    $replace[17] = '<table cellpadding="0" cellspacing="2" class="$1 table table-striped table-hover table-condensed sortable-theme-bootstrap" data-sortable="" data-sortable-initialized="true">';
    $pattern[18] = '/<th class=\"title_c\"\>([^>]*)\<\/th\>/';
    $replace[18] = '<th class="panel-default"><div class="panel-heading"><h2 class="panel-title">$1</div></div></th>';
    $pattern[19] = '/<a href=\"http/';
    $replace[19] = '<a target="_blank" href="http';
    $pattern[20] = '/<img src=\"\S+\W[a-zA-Z0-9.-]+.png\" title=\"date\/time report\" alt=\"T\">/';
    $replace[20] = '<i class="fa fa-clock-o icon-black"></i>';
    $pattern[21] = '/<img src=\"\S+\W[a-zA-Z0-9.-]+.png\" title=\"Graphic\" alt=\"G\">/';
    $replace[21] = '<i class="fa fa-bar-chart"></i>';
    $pattern[22] = '/<div class=\"title\">/';
    $replace[22] = '<div class="panel panel-default"><div class="title">';
    $pattern[23] = '/<div class=\"report content\">/';
    $replace[23] = '<\/div><div class="report content">';    
    $pattern[24] = '/<tr><(td|th) class=\"\"/';
    $replace[24] = '<tr><$1 class="content"';
    $pattern[25] = '/<th class=\"content\">(.*?)<\/th><\/tr>[\s\S]<\/tbody><\/table>/';
    $replace[25] = '<th class="panel-heading"><h2 class="panel-title"><a href="javascript:history.go(-1)"><i class="fa fa-arrow-left text-primary" title="Back"></i></a>&nbsp;$1</h2></th></tr></tbody></table>';
    $pattern[26] = '/<tr><td class=\"link\" colspan=\"0\">/';
    $replace[26] = '<tr class="btn btn-default btn-sm"><td colspan="0">';
    $pattern[27] = '/<div class=\"buttons\"><table cellpadding=\"0\" cellspacing=\"2\">/';
    $replace[27] = '<div class="buttons content"><table cellpadding="0" cellspacing="2" style="display: flex" class="btn-group">';
    $pattern[28] = '/<tr><td class=\"data\">(.*?)<td class=\"data\">DENIED<\/td><\/tr>/';
    $replace[28] = '<tr><td class="data"><i class="fa fa-times-circle text-danger icon-primary" title="DENIED"></i>&nbsp;$1</tr>';
    $pattern[29] = '/<tr><td class=\"data\"><a href=\/sarg_(.*?)<\/td><td>(.*?)<\/td><td (.*?)>(.*?)<\/td><td (.*?)>(.*?)<\/td><td (.*?)>(.*?)<\/td><td (.*?)>(.*?)<\/td><td (.*?)>(.*?)<\/td><td (.*?)>(.*?)<\/td><td (.*?)>(.*?)<\/td><td class=\"data\">(.*?)<\/td><\/tr>/';
    $replace[29] = '<tr><td class="data"><i class="text-success fa fa-check-circle fa-1x" title="ACCESS"></i>&nbsp;<a href=/sarg_$1</td><td>$2</td><td $3>$4</td><td $5>$6</td><td $7>$8</td><td $9>$10</td><td $11>$12</td><td $13>$14</td><td $15>$16</td><td class="data">$17</td></tr>';
    $pattern[31] = '/<tr><td><img src=\"(\S+\W[a-zA-Z0-9.-]+.png)\" alt=\"B\"><\/td><\/tr>/';
    $replace[31] = '<tr class="panel-default"><td class="panel-heading"><h2 class="panel-title">E2guardian User Access Reports</h2></td></tr><tr><td><h2 class="panel-title"><a href="javascript:history.go(-1)"><i class="fa fa-arrow-left text-primary" title="Back"></i></a>&nbsp;Graph report</h2><div class="content print-group btn-group pull-right"><a href="javascript:printPage()" class="btn btn-default btn-sm">Print</a></div></td></tr><tr><td><img src="$1" alt="B"></td></tr>';
    $pattern[33] = '/<tr><(.*?)>Sort:(.*?)<\/td><\/tr>/';
    $replace[33] = '';
    $pattern[34] = '/<table cellpadding=\"0\" cellspacing=\"2\" class=\"(sortable|report) table/';
    $replace[34] = '<div class="content print-group btn-group pull-right"><a href="javascript:exportToCSV(\'printable\')" class="btn btn-default btn-sm">Excel</a><a href="javascript:exportToCSV(\'printable\', \',\')" class="btn btn-default btn-sm">CSV</a><a href="javascript:printPage()" class="btn btn-default btn-sm">Print</a></div><table id="printable" cellpadding="0" cellspacing="2" class="sortable table';
    $pattern[35] = '/<body>\s<div class=\"content print-group btn-group pull-right\">(.*?)<\/div><table/';
    $replace[35] = '<body><table';
    $pattern[40] = '/<table/';
    $replace[40] = '<table width="100%"';

	// look for graph files inside reports. 
	if (preg_match_all('/img src="([a-zA-Z0-9._-]+).png/', $report, $images)) {
		conf_mount_rw();
		for ($x = 0; $x < count($images[1]); $x++) {
			copy("{$dir}/{$prefix}/{$images[1][$x]}.png", "/usr/local/www/sarg-images/temp/{$images[1][$x]}.{$rand}.png");
		}
		conf_mount_ro();
	}
	print preg_replace($pattern, $replace, $report);
} else {
	print "Error: Could not find report index file.<br />Check and save Sarg settings and try to force Sarg schedule.";
}

?>
