# Changes

## Updated squidanalyzer 6.5 to 6.6
replaced /usr/local/lib/perl5/site_perl/SquidAnalyzer.pm

with SquidAnalyzer.pm (6.6) from https://github.com/darold/squidanalyzer

To try: run "squid-analyzer /var/log/e2guardian/access.log -r"

## /usr/local/www/widgets/widgets/e2guardian.widget.php:56
function e2guardian_show_dstats($count = 5) {
	exec("/usr/bin/tail -{$count} /var/log/e2guardian/dstats.log",$dstats);
	for ($d = ($count -1); $d >= 0; $d--) {
		print "<tr>\n";
		$dstat = preg_replace("/\s+/"," ",$dstats[$d]);
		$fields = explode(" ",$dstat);
		//$fields[0] = date('r', $fields[0]);
		print "<th style='text-align:right;'><a>" . date('H:i',(float)$fields[0]) . "</a></th>\n";
		for ($i = 2; $i < 11; $i++) {
			print "<th style='text-align:right;'><a>" . number_format((float)$fields[$i],0,"",".") . "</a></th>\n";
		}
		print "</tr>\n";
	}
}

##  /usr/local/www/e2guardian.php:171
if (($config['installedpackages']['e2guardianblacklistsdomains']['config'] != null) && (count($config['installedpackages']['e2guardianblacklistsdomains']['config']) > 18)) {
