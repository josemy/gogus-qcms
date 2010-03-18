<?php
    # status.php -- very simple server status monitor
    header( 'Content-type: text/plain' );
    # Get and display load average times 3
    $load = sys_getloadavg();
    echo "LoadAverage1: $load[0]\n";
    echo "LoadAverage5: $load[1]\n";
    echo "LoadAverage15: $load[2]\n";
	# Count running processes
    $procs = `/bin/ps -e|wc -l`;
    echo "RunningProcesses: $procs\n";
	system("ps -A");
	

?>
