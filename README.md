# pfSense-ports

##Install dependencies
pkg install libgd
pkg add http://pkg.freebsd.org/FreeBSD:14:amd64/latest/All/sarg-2.4.0_2.pkg
pkg add https://pkg.freebsd.org/FreeBSD:14:amd64/latest/All/squidanalyzer-6.5.pkg

##Install packages
pkg add [packet-name]

##Generate Packages
Unzip original package

xz -d pfSense-pkg-Sarg-0.6.15_2.txz
tar xvf pfSense-pkg-Sarg-0.6.15_2.tar

Edit the +MANIFEST
pkg create -M ./+MANIFEST

##Update squidanalyzer 6.5 to 6.6
replace /usr/local/lib/perl5/site_perl/SquidAnalyzer.pm
with SquidAnalyzer.pm (6.6) from https://github.com/darold/squidanalyzer
then run "squid-analyzer /var/log/e2guardian/access.log -r"

##To configure squidanalyzer
/var/log/e2guardian/access.log
