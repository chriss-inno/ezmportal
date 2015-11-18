1. Insert a tep into tape section and check if the green color stop blink 
2. Telnet 1.10 
3. cd /data1_netapp
4. copy the dmp and idx files 
5. Run 

fbackup -f /dev/rmt/0m -i /data1_netapp/expdp_PROD_FCC_29102015_210810.dmp -I expdp_PROD_FCC_29102015_210810.idx

The script will start copying to tep. and the green color will start to blink, wait until the blink stop

6.Run  

frecover -I - -f /dev/rmt/0m  

The script above verify the data copied into tape matches with the data available 