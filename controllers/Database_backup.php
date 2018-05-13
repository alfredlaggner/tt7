<?

class Database_backup extends CI_Controller
{
	function index()
	{
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$server_dir = PROD_SERVER_DIR . 'backup/mybackup.sql.' . date('m-d-Y_hia') . '.zip';
		$prefs = array(
			'tables' => array(),  // Array of tables to backup.
			'ignore' => array(),           // List of tables to omit from the backup
			'format' => 'zip',
			$filename = "mybackup.sql_" . date('m-d-Y_hia') . ".zip", // gzip, zip, txt
			'add_drop' => TRUE,              // Whether to add DROP TABLE statements to backup file
			'add_insert' => TRUE,              // Whether to add INSERT data to backup file
			'newline' => "\n"               // Newline character used in backup file
		);
		$backup = $this->dbutil->backup($prefs);
		if (write_file($server_dir, $backup)) {
			echo "Database backed up successfully";
		} else {
			echo "Hoops, something went wrong!";
		}
	}
}