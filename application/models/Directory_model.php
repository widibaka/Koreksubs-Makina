<?php 

class Directory_model extends CI_Model
{
	//Delete folder all containing files
	public function deleteDir($dirPath) {
	    if (! is_dir($dirPath)) {
	        throw new InvalidArgumentException("$dirPath must be a directory");
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }
	    rmdir($dirPath);
	}

	//Delete isi folder saja
	public function deleteFilesOfDir($dirPath, $kecuali) {
	    if (! is_dir($dirPath)) {
	        throw new InvalidArgumentException("$dirPath must be a directory");
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if(!stristr($file, $kecuali)) {
	            unlink($file);
	        }
	    }
	}
	
	/**
	 * Function ini akan membuat data array
	 * dari files yang ada di suatu directory.
	 * @return array
	 */
	public function directory_to_array($directory): array
	{
		$files = array();

		if ($handle = opendir($directory))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file !== '.' && $file !== '..')
				{
					$file = $directory . '/' . $file;

					$files[] = preg_replace("/\/\//si", '/', $file);
				}
			}

			closedir($handle);
		}

		return $files;
	}


}