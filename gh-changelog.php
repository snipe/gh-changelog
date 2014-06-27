<?php
#!/usr/bin/php -q

$gh_user = 'your-user';
$gh_repo = 'your-repo';
$file = 'CHANGELOG.md';
$string = 'fix|resolve|closes|closed|#changelog';

$url = 'https://api.github.com/repos/'.$gh_user.'/'.$gh_repo.'/releases';
    
$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	curl_setopt($ch,CURLOPT_USERAGENT,$gh_user);
	$data = curl_exec($ch);
	curl_close($ch);


$obj = json_decode($data, TRUE);
$changelog = '';
file_put_contents($file,$changelog);

for($i=0; $i<count($obj); $i++) {
	$next = $i+1;
	
	if ((count($obj) > $next)) {
	    echo "Info:  " . $obj[$i]['name']." (".$obj[$i]['tag_name'].") - created ".date("M d, Y h:i:s",strtotime($obj[$i]['created_at']))."\n";
	    if ($obj[$i]['prerelease']=='true') {
		    $pre ='#### This is a pre-release ';
	    } else {
		    $pre ='';
	    }
	    $changelog = "\n\n###  ".$obj[$i]['name']." - Released ".date("M d, Y h:i:s",strtotime($obj[$i]['created_at']))."\n".$pre."\n";
	    file_put_contents($file,$changelog,FILE_APPEND);
	    $gitlog = 'git log '.escapeshellarg($obj[$i]['tag_name']).'...'.escapeshellarg($obj[$next]['tag_name']).' --pretty=format:\'* <a href="http://github.com/snipe/snipe-it/commit/%H">view commit &bull;</a> %s \' --reverse | grep -i -E "'.$string.'" >> '.$file;
	    exec($gitlog);
  
    }
}

