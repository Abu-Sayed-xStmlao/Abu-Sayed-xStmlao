<?php
//SOURCE_CODE FOR XML DISTINCT 
//IDENTIFY SET IN PHP MYSQLI
//XSTMLAO | TECHNICAL
// http://xstmlaotechnical.epizy.com/
//INCLUDE DATABASE_CONFIG_FILE
include "db_conn.php";
//REQUESTED_FILE_IDENTIFY
$requested_identify = base64_decode($_REQUEST["identify"]);
//HTML_ENTITIES_DECODE
function decode_html($str){
	$exp = str_ireplace("&", "&amp;", $str);
	$xar = array("<", ">", "\"", "'", "\\");
	$yar = array("&lt;", "&gt;", "&quot;", "&apos;", "&bsol;");
	$scaned_str = str_ireplace($xar, $yar, $exp);
	return $scaned_str;
}
//REGEXP_IDEA
$exp = "_msi_1654022473744864_linefeed_";
$ext = "_escape_1654022473775875_tabchar_";
$xml = "./xml/" .$requested_identify;
$xml = file_get_contents($xml);
$xml = preg_replace("/\n/", "\n$exp", $xml);
$xml = preg_replace("/\n($exp)\s+<([a-z]{3}\s{1}[\w]{5,7})=\"/", "\n\t<sms address=\"", $xml);
$xml = preg_replace("/\n($exp)<([\w]{4}ms)\s{1}c[a-z]{3}t\s?=\"/", "\n<allsms count=\"", $xml);
$xml = preg_replace("/\n($exp)\s{1,}<\/[\w]{6}>/", "\n\t</allsms>", $xml);

//FOR_TAB_CHAR

$xml = preg_replace("/\t/", $ext, $xml);
$xml = preg_replace("/\n$ext<s[a-z]{2}\sadd[a-z]{4}=\"/", "\n\t<sms address=\"" , $xml);
$xml = preg_replace("/\n$ext<\/all[a-z]{2}s>/", "\n\t</allsms>", $xml);

//LOAD_XML_STRING
$xml = simplexml_load_string($xml);
$xml = json_encode($xml);
$xml = json_decode($xml, true);
$xml = $xml["sms"];
//CHECKING_ALL_DATA
for($i = 0; $i < count($xml); $i++){
	$xml_data = $xml[$i]["@attributes"];
	$xml_address = decode_html($xml_data["address"]);
	//FINDING_BANGLADESHI_ADDRESS
	if(strlen($xml_address) > 11 && preg_match("/^\+?\d[0-9-\s\(\)]/", $xml_address) === 1){
		$xml_address = preg_replace("/\s+|-|\(|\)/", "", $xml_address);
	}
	$xml_address = preg_replace("/^\+{0,1}(88){0,1}(0){0,1}(1){1}(\d{1,})/", "+8801$4", $xml_address);
	//TARGETS
	$xml_microtime = substr($xml_data["date"], 0, 13);
	$xml_date = substr($xml_microtime, 0, 10);
	$xml_type = $xml_data["type"];
	$xml_content = preg_replace("/\s{1}$exp/", "\n", decode_html(str_replace($ext, "\t", $xml_data["body"])));
	$ext_cmd = "
		SELECT * FROM messages WHERE
		unix = '$xml_date' AND
		content = '$xml_content' AND
		address = '$xml_address' AND
		type = '$xml_type' ";
	$ext_cmd_exc = mysqli_query($db_conn, $ext_cmd);
	if(mysqli_num_rows($ext_cmd_exc) > 0){
		echo "";
	}else{
		//INSERT COMMAND
		$save_cmd = "INSERT INTO messages (
		unix, content, 
		type, address, 
		microtime
		)
		VALUES (
		'$xml_date', '$xml_content',
		'$xml_type', '$xml_address',
		'$xml_microtime'
		)";
		$save_cmd_exc = mysqli_query($db_conn, $save_cmd);
		if($save_cmd_exc){
			echo "";
		}else{
			echo "<div class=\"ajax_status\">
			this {$xml_content} isn't saved!
			</div>" ;
		}
	}
}
$xml_remove_request_dir = "./xml/";
$xml_remove_request_file = $requested_identify;
$xml_remove_dir = "./encrypted/";
$xml_remove = rename($xml_remove_request_dir.$xml_remove_request_file, $xml_remove_dir. preg_replace("/\.xml$/", ".encrypted", $xml_remove_request_file) );
if($xml_remove){
	echo '<div class="ajax_status">loaded = '. $xml_remove_request_file.'<br></div>';
	
	?>

<?php
function size_set($int) {
	$str_int = $int;
	if ($str_int >= 1024) {
		$str_int = number_format(($str_int / 1024), 2) . "K";
	} elseif ($str_int >= (1024 * 1024)) {
		$str_int = number_format(($str_int / (1024 * 1024)), 2). "M";
	} else {
		$str_int = $str_int;
	}
	return $str_int;
}
$xml_location = "./xml/";
$xml_files = scandir($xml_location);
for ($i = 0; $i < count($xml_files); $i++) {
	if ($xml_files[$i] != "." && $xml_files[$i] != "..") {
		?>
		<div href="<?php
			$identify = preg_replace("/={0,}/", "", base64_encode($xml_files[$i]));
			echo $identify;
			?>" class="xml">
			<div class="xml_name">
				<?php echo $xml_files[$i]; ?>
			</div>
			<div class="xml_size">
				<span>size://</span><?php
				echo size_set(filesize($xml_location.$xml_files[$i]));
				?>
			</div>
		</div>
		<?php
	}
}
?>
<script>
	controller();
	first_ajax();
</script>
	<?php
}else{
	echo "error";
}
?>
