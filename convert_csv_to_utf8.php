<?php
/**
 * [convert_csv_to_utf8 description]
 * convert CSV file encoding to utf-8
 */
class convert_csv_to_utf8
{
    public function convert_csv_to_utf8($file_address,$saveto=false)
    {
        $auto_detect_line_endings = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', TRUE);
        if (($handle = fopen($file_address, "r")) !== FALSE) {
            $encoding = 'UTF-8';
            if (function_exists('mb_detect_encoding')) {
                $file_contents = file_get_contents($file_address);
                $encoding      = mb_detect_encoding($file_contents, "UTF-8,ISO-8859-1,WINDOWS-1251");
            }
            $finaltext = "";
            while (($csv = fgetcsv($handle, 0)) !== FALSE) {
                $csv_data  = array();
                foreach ($csv as $col_id => $col) {
                    $csv_data[] = html_entity_decode($this->convert_encoding($col, $encoding));
                }
                $finaltext .= implode(",", $csv_data) . "\n";
            }
            fclose($handle);
            ini_set('auto_detect_line_endings', $auto_detect_line_endings);
			if(!$saveto)
				file_put_contents($file_address, $finaltext);
			else
				file_put_contents($saveto, $finaltext);
			echo "converted";

			return true;
        } else {

            ini_set('auto_detect_line_endings', $auto_detect_line_endings);

            echo "file_not_find";

            return false;
        }
    }
	
	public static function convert_to_utf8($data, $encoding)
    {
        if (function_exists('iconv')) {
            $out = @iconv($encoding, 'utf-8', $data);
        } else if (function_exists('mb_convert_encoding')) {
            $out = @mb_convert_encoding($data, 'utf-8', $encoding);
        } elseif (function_exists('recode_string')) {
            $out = @recode_string($encoding . '..utf-8', $data);
        } else {
            return FALSE;
        }
        return $out;
    }
	
    public function convert_encoding($data, $encoding)
    {
        if ($encoding == 'UTF-8') {
            return $data;
        }
        if ($encoded_data = $this->convert_to_utf8($data, $encoding)) {
            return $encoded_data;
        }
        return $data;
    }
}
