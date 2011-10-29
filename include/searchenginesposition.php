<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.1
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Code cleaning: Philippe Villiers
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: searchenginesposition.php
//----------------------------------------------------------------------
//  Last update: 29/10/2011
//----------------------------------------------------------------------
//nusoap
require_once (dirname(__FILE__).'/../nusoap/class.nusoap_base.php');
require_once (dirname(__FILE__).'/../nusoap/class.soap_transport_http.php');
require_once (dirname(__FILE__).'/../nusoap/class.soap_val.php');
require_once (dirname(__FILE__).'/../nusoap/class.soap_parser.php');
require_once (dirname(__FILE__).'/../nusoap/class.soap_fault.php');
require_once (dirname(__FILE__).'/../nusoap/class.soapclient.php');


//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//mysql query for site id and url
$crawltsql = "SELECT id_site, url  FROM crawlt_site";
$crawltrequete = mysql_query($crawltsql, $crawltconnexion);
$crawltnbrresult = mysql_num_rows($crawltrequete);
$crawltnbrresult2 = ($crawltnbrresult * 2);
$crawltnbrresult3 = ($crawltnbrresult * 3);
$crawltnbrresult4 = ($crawltnbrresult * 4);
//initialize array
$listsitecrawlt = array();
$crawltsiteurl = array();
if ($crawltnbrresult >= 1) {
	while ($crawltligne = mysql_fetch_row($crawltrequete)) {
		$listsitecrawlt[] = $crawltligne[0];
		$crawltsiteurl[$crawltligne[0]] = $crawltligne[1];
	}
}
//looking for position in search engines database using api
//test loop position
if ($crawltloop < $crawltnbrresult) {
	//Exalead
	$crawltidsite = ($crawltloop - $crawltnbrresult);
	$crawltsite = $listsitecrawlt[$crawltidsite];
	$crawlturlsite = $crawltsiteurl[$crawltsite];
	if (empty($crawlturlsite)) {
		//update the crawlt_config table
		$crawltloopnext = $crawltloop + 1;
		$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='0', loop1='" . crawlt_sql_quote($crawltloopnext) . "'";
		$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
	} else {
		//to avoid problem if the url is enter in the database with http://
		$crawlturlsite = strip_protocol($crawlturlsite);
		if ($crawltloop2 == 0) { //we replace link msn which is no more available by link and page Exalead
			//exalead links
			$crawltrequete1 = "http://www.exalead.com/search/web/results?q=link:$crawlturlsite";
			// Try to temporarly allow url_fopen
			if (ini_get('allow_url_fopen') != 1) {
				@ini_set('allow_url_fopen', '1');
			}
			$crawltnbrexalead1 = 0;
			if (ini_get('allow_url_fopen') == 1) {
				$result = file_get_contents($crawltrequete1);
				if(preg_match('#<span class="orange">([^<]+)</span>#iUs', $result, $matches))
					$crawltnbrexalead1 = str_replace(",", "", $matches[1]);
			}
			//insert values in the crawlt_seo_position table
			//check if the date already exists in the table
			$crawltsqlcheck = "SELECT `date`, id_site, linkexalead  FROM crawlt_seo_position
                        WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
                        AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
			$crawltrequetecheck = mysql_query($crawltsqlcheck, $crawltconnexion);
			$crawltnbrresultcheck = mysql_num_rows($crawltrequetecheck);
			if ($crawltnbrresultcheck >= 1) {
				$crawltligne = mysql_fetch_assoc($crawltrequetecheck);
				$crawltexitingvalue = $crawltligne['linkexalead'];
				if($crawltexitingvalue == 0) {
				$crawltsqlseo = "UPDATE crawlt_seo_position SET linkexalead='" . crawlt_sql_quote($crawltnbrexalead1) . "'
                          WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
                          AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
			} else {
				$crawltsqlseo = "INSERT INTO crawlt_seo_position (`date`, id_site, linkyahoo, pageyahoo, linkmsn, pagemsn, nbrdelicious, tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle) VALUES ( '" . crawlt_sql_quote($crawltdatetoday2) . "','" . crawlt_sql_quote($crawltsite) . "','0','0','0','0','0',' ','" . crawlt_sql_quote($crawltnbrexalead1) . "','0','0','0')";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
			$crawltloop2next = $crawltloop2 + 1;
			//update the crawlt_config table
			$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='" . crawlt_sql_quote($crawltloop2next) . "'";
			$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
		} elseif ($crawltloop2 == 1) {
			//exalead pages
			$crawltrequete2 = "http://www.exalead.com/search/web/results?q=site:$crawlturlsite";
			// Try to temporarly allow url_fopen
			if (ini_get('allow_url_fopen') != 1) {
				@ini_set('allow_url_fopen', '1');
			}
			$crawltnbrexalead2 = 0;
			if (ini_get('allow_url_fopen') == 1) {
				$result = file_get_contents($crawltrequete2);
				if(preg_match('#<span class="orange">([^<]+)</span>#iUs', $result, $matches))
					$crawltnbrexalead2 = str_replace(",", "", $matches[1]);
			}
			//insert values in the crawlt_seo_position table
			//check if the date already exists in the table
			$crawltsqlcheck = "SELECT `date`, id_site, pageexalead  FROM crawlt_seo_position
                        WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
                        AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
			$crawltrequetecheck = mysql_query($crawltsqlcheck, $crawltconnexion);
			$crawltnbrresultcheck = mysql_num_rows($crawltrequetecheck);
			if ($crawltnbrresultcheck >= 1) {
				$crawltligne = mysql_fetch_assoc($crawltrequetecheck);
				$crawltexitingvalue = $crawltligne['pageexalead'];
				if($crawltexitingvalue == 0) {				
				$crawltsqlseo = "UPDATE crawlt_seo_position SET pageexalead='" . crawlt_sql_quote($crawltnbrexalead2) . "'
                          WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
                          AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
			} else {
				$crawltsqlseo = "INSERT INTO crawlt_seo_position (date,id_site, linkyahoo, pageyahoo, linkmsn, pagemsn, nbrdelicious, tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle) VALUES ( '" . crawlt_sql_quote($crawltdatetoday2) . "','" . crawlt_sql_quote($crawltsite) . "','0','0','0','0','0',' ','0','" . crawlt_sql_quote($crawltnbrexalead2) . "','0','0')";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
			//update the crawlt_config table
			$crawltloopnext = $crawltloop + 1;
			$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='0', loop1='" . crawlt_sql_quote($crawltloopnext) . "'";
			$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
		} 
	}
} elseif ($crawltloop >= $crawltnbrresult2 && $crawltloop < $crawltnbrresult2) {
	//del.icio.us
	//initialize array & variables
	$crawltnbrpertag = array();
	$crawltnbrtag = array();
	$crawltnbrtag2 = array();
	$crawlttag = array();
	$crawlttag2 = array();
	$crawlttag4 = array();
	$crawlttag3 = '';
	$crawltresultdelicious = '';
	$crawlttagtab = '';
	$crawltidsite = ($crawltloop - $crawltnbrresult2);
	$crawltsite = $listsitecrawlt[$crawltidsite];
	$crawlturlsite = $crawltsiteurl[$crawltsite];
	if (empty($crawlturlsite)) {
		//update the crawlt_config table
		$crawltloopnext = $crawltloop + 1;
		$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='0', loop1='" . crawlt_sql_quote($crawltloopnext) . "'";
		$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
	} else {
		//to avoid problem if the url is enter in the database with http://
		$crawlturlsite = strip_protocol($crawlturlsite);
		$crawlturlsite2 = "http://" . $crawlturlsite . "/";
		$crawltquery1 = "http://badges.del.icio.us/feeds/json/url/blogbadge?hash=" . md5($crawlturlsite2);
		// Try to temporarly allow url_fopen
		if (ini_get('allow_url_fopen') != 1) {
			@ini_set('allow_url_fopen', '1');
		}
		$crawltnbrtagdelicious = 0;
		$crawlttagtab = " ";
		if (ini_get('allow_url_fopen') == 1) {
			$crawltresultdelicious = file_get_contents($crawltquery1);
			$crawltnbrtag = explode("\"total_posts\":", $crawltresultdelicious);
			if (count($crawltnbrtag) == 1) {
				$crawltnbrtagdelicious = 0;
				$crawlttagtab = " ";
			} else {
				//delicious tags
				$crawltnbrtag2 = explode("}", $crawltnbrtag[1]);
				$crawltnbrtagdelicious = $crawltnbrtag2[0];
				$crawlttag = explode("\"top_tags\":{\"", $crawltresultdelicious);
				$crawlttag2 = explode("}", $crawlttag[1]);
				$crawlttag3 = str_replace(":", "", $crawlttag2[0]);
				$crawlttag3 = str_replace(",", "", $crawlttag3);
				$crawlttag4 = explode("\"", $crawlttag3);
				$n = count($crawlttag4);
				for ($i = 0;$i < $n;$i++) {
					if ($i % 2 == 0) {
						$crawltnbrpertag[$crawlttag4[$i]] = $crawlttag4[$i + 1];
					}
				}
				$crawlttagtab = serialize($crawltnbrpertag);
			}
		}
		//insert values in the crawlt_seo_position table
		//check if the date already exists in the table
		$crawltsqlcheck = "SELECT `date`, id_site, nbrdelicious  FROM crawlt_seo_position
			WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
			AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
		$crawltrequetecheck = mysql_query($crawltsqlcheck, $crawltconnexion);
		$nbrresultcheck = mysql_num_rows($crawltrequetecheck);
		if ($nbrresultcheck >= 1) {
				$crawltligne = mysql_fetch_assoc($crawltrequetecheck);
				$crawltexitingvalue = $crawltligne['nbrdelicious'];
				if($crawltexitingvalue == 0) {
			$crawltsqlseo = "UPDATE crawlt_seo_position SET nbrdelicious='" . crawlt_sql_quote($crawltnbrtagdelicious) . "',tagdelicious='" . crawlt_sql_quote($crawlttagtab) . "'
				WHERE date= '" . crawlt_sql_quote($crawltdatetoday2) . "'
				AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
			$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
		} else {
			$crawltsqlseo = "INSERT INTO crawlt_seo_position (`date`, id_site, linkyahoo, pageyahoo, linkmsn, pagemsn, nbrdelicious, tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle) VALUES ( '" . crawlt_sql_quote($crawltdatetoday2) . "','" . crawlt_sql_quote($crawltsite) . "','0','0','0','0','" . crawlt_sql_quote($crawltnbrtagdelicious) . "','" . crawlt_sql_quote($crawlttagtab) . "','0','0','0','0')";
			$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
		}
		//update the crawlt_config table
		$crawltloopnext = $crawltloop + 1;
		$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='0', loop1='" . crawlt_sql_quote($crawltloopnext) . "'";
		$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
	}
} elseif ($crawltloop >= $crawltnbrresult3 && $crawltloop < $crawltnbrresult3) {
	//google
	$crawltidsite = ($crawltloop - $crawltnbrresult3);
	$crawltsite = $listsitecrawlt[$crawltidsite];
	$crawlturlsite = $crawltsiteurl[$crawltsite];
	if (empty($crawlturlsite)) {
		//update the crawlt_config table
		$crawltloopnext = $crawltloop + 1;
		$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='0', loop1='" . crawlt_sql_quote($crawltloopnext) . "'";
		$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
	} else {
		//to avoid problem if the url is enter in the database with http://
		$crawlturlsite = strip_protocol($crawlturlsite);
		if ($crawltloop2 == 0) {
			$crawltrequete1 = "link:$crawlturlsite";
			$crawltquery1 = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=" . rawurlencode($crawltrequete1);
			// Try to temporarly allow url_fopen
			if (ini_get('allow_url_fopen') != 1) {
				@ini_set('allow_url_fopen', '1');
			}
			$crawltnbrgoogle1 = 0;
			if (ini_get('allow_url_fopen') == 1) {
			$crawltxml1 = file_get_contents($crawltquery1);
				if(stristr($crawltxml1, 'estimatedResultCount":"') !== false) {
					$crawltsearch = explode('estimatedResultCount":"', $crawltxml1);
					$crawltsearch2 = explode('","currentPageIndex', $crawltsearch[1]);
					$crawltnbrgoogle1 = $crawltsearch2[0];
					if (empty($crawltnbrgoogle1)) {
						$crawltnbrgoogle1 = 0;
					}
				}
			}
			//check if the date already exists in the table
			$crawltsqlcheck = "SELECT `date`, id_site, linkgoogle  FROM crawlt_seo_position
				WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
				AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
			$crawltrequetecheck = mysql_query($crawltsqlcheck, $crawltconnexion);
			$crawltnbrresultcheck = mysql_num_rows($crawltrequetecheck);
			if ($crawltnbrresultcheck >= 1) {
				$crawltligne = mysql_fetch_assoc($crawltrequetecheck);
				$crawltexitingvalue = $crawltligne['linkgoogle'];
				if($crawltexitingvalue == 0) {
				$crawltsqlseo = "UPDATE crawlt_seo_position SET linkgoogle='" . crawlt_sql_quote($crawltnbrgoogle1) . "'
					WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
					AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
				}					
			} else {
				$crawltsqlseo = "INSERT INTO crawlt_seo_position (`date`, id_site, linkyahoo, pageyahoo, linkmsn, pagemsn, nbrdelicious, tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle) VALUES ( '" . crawlt_sql_quote($crawltdatetoday2) . "','" . crawlt_sql_quote($crawltsite) . "','0','0','0','0','0',' ','0','0','" . crawlt_sql_quote($crawltnbrgoogle1) . "','0')";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
			$crawltloop2next = $crawltloop2 + 1;
			//update the crawlt_config table
			$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='" . crawlt_sql_quote($crawltloop2next) . "'";
			$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
		} else {
			$crawltrequete2 = "site:$crawlturlsite";
			$crawltquery2 = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=" . rawurlencode($crawltrequete2);
			// Try to temporarly allow url_fopen
			if (ini_get('allow_url_fopen') != 1) {
				@ini_set('allow_url_fopen', '1');
			}
			
			$crawltnbrgoogle2 = 0;
			if (ini_get('allow_url_fopen') == 1) {
			$crawltxml2 = file_get_contents($crawltquery2);
				if(stristr($crawltxml2, 'estimatedResultCount":"') !== false) {
					$crawltsearch = explode('estimatedResultCount":"', $crawltxml2);
					$crawltsearch2 = explode('","currentPageIndex', $crawltsearch[1]);
					$crawltnbrgoogle2 = $crawltsearch2[0];
					if (empty($crawltnbrgoogle2)) {
						$crawltnbrgoogle2 = 0;
					}
				}
			}
			//check if the date already exists in the table
			$crawltsqlcheck = "SELECT `date`, id_site, pagegoogle  FROM crawlt_seo_position
				WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
				AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
			$crawltrequetecheck = mysql_query($crawltsqlcheck, $crawltconnexion);
			$crawltnbrresultcheck = mysql_num_rows($crawltrequetecheck);
			if ($crawltnbrresultcheck >= 1) {
				$crawltligne = mysql_fetch_assoc($crawltrequetecheck);
				$crawltexitingvalue = $crawltligne['pagegoogle'];
				if($crawltexitingvalue == 0) {
				$crawltsqlseo = "UPDATE crawlt_seo_position SET pagegoogle='" . crawlt_sql_quote($crawltnbrgoogle2) . "'
					WHERE `date`= '" . crawlt_sql_quote($crawltdatetoday2) . "'
					AND id_site='" . crawlt_sql_quote($crawltsite) . "'";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
				}					
			} else {
				$crawltsqlseo = "INSERT INTO crawlt_seo_position (`date`, id_site, linkyahoo, pageyahoo, linkmsn, pagemsn, nbrdelicious, tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle) VALUES ( '" . crawlt_sql_quote($crawltdatetoday2) . "','" . crawlt_sql_quote($crawltsite) . "','0','0','0','0','0',' ','0','0','0','" . crawlt_sql_quote($crawltnbrgoogle2) . "')";
				$crawltrequeteseo = mysql_query($crawltsqlseo, $crawltconnexion);
			}
			//update the crawlt_config table
			$crawltloopnext = $crawltloop + 1;
			$crawltsqlupdateseo = "UPDATE crawlt_config SET loop2='0', loop1='" . crawlt_sql_quote($crawltloopnext) . "'";
			$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
		}
	}
} else {
	//update the crawlt_config table
	$crawltsqlupdateseo = "UPDATE crawlt_config SET loop1='0', datelastseorequest='" . crawlt_sql_quote($crawltdatetoday) . "'";
	$crawltrequeteupdateseo = mysql_query($crawltsqlupdateseo, $crawltconnexion);
}
?>
