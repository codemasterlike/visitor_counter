<div style="padding: 0px; ">
            <center>
                <!-- Visitor Counter Start-->    
            
            
                   <?php
            
                 $host = ""; // server
                 $user = ""; // username
                 $pass = ""; // password
                 $database = ""; // name database
                
                 $koneksi = mysqli_connect($host, $user, $pass, $database); // use mysqli_connect
                
                 if(mysqli_connect_error()){ // check if the database connection error
                    echo 'Error In Connecting To Database: '.mysqli_connect_error(); // message when database connection error
                 }
                 
        
                 $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                 $date = date("Ymd");
                 $TIME = time();
                 $bln=date("m");
                 $tgl=date("d");
                 $MONTH=date("Y-m");
                 $YEAR=date("Y");
                 $tglk=$tgl-1;
                 $s = mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE ip='$ip' AND date='$date'");
        
                 if(mysqli_num_rows($s) == 0)
                 {
                    mysqli_query($koneksi,"INSERT INTO tbvisit_alocentral(ip, date, hits, online) VALUES('$ip','$date','1','$TIME')");
                 }
                 else
                 {
                  mysqli_query($koneksi,"UPDATE tbvisit_alocentral SET hits=hits+1, online='$TIME' WHERE ip='$ip' AND date='$date'");
        
                     if($tglk=='1' | $tglk=='2' | $tglk=='3' | $tglk=='4' | $tglk=='5' | $tglk=='6' | $tglk=='7' | $tglk=='8' | $tglk=='9'){
                        $YESTERDAY=mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE date='$YEAR-$bln-0$tglk'");
                     } else {
                        $YESTERDAY=mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE date='$YEAR-$bln-$tglk'");
                     }
        
                     $bulan=mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE date LIKE '%$MONTH%'");
                     $bulan1=mysqli_num_rows($bulan);
                     $tahunini=mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE date LIKE '%$YEAR%'");
                     $tahunini1=mysqli_num_rows($tahunini);
                     $TODAY = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE date='$date' GROUP BY ip"));
                     $TOTAL_TODAY = mysqli_fetch_array(mysqli_query($koneksi,"SELECT COUNT(hits) FROM tbvisit_alocentral"));
                     $hits = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT SUM(hits) as hitstoday FROM tbvisit_alocentral WHERE date='$date' GROUP BY date"));
                     $totalhits1 =mysqli_query($koneksi,"SELECT SUM(hits) FROM tbvisit_alocentral");
                     $test=mysqli_fetch_array($totalhits1);
                     $totalhits=$test[0];
                     $bataswaktu = time() - 900;
                     $ONLINE = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbvisit_alocentral WHERE online > '$bataswaktu'"));
                     $YESTERDAY1 = mysqli_num_rows($YESTERDAY);
                     
                     
                     $A=mysqli_fetch_assoc(mysqli_query($koneksi,"Select Sum(hits) From tbvisit_alocentral Group By date"));
                     $record_value=1000;
                     $record_value=mysqli_fetch_assoc(mysqli_query($koneksi,"Select max(A) From tbvisit_alocentral Group By date"));
                     
                  }
                   
                   
                   // neuer record?
        	 
              
        	  if ($hits[hitstoday] > $record_value)
        	  {
        	     $record_value = $hits[hitstoday];
        	     $record_date = date("Y-m-d H:i:s");
        	  }
                  
                ?>
                <center>
                    <div style="background: #4388ed; border-radius: 12px">
