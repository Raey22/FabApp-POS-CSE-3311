# CSE 3311 - FabLab POS

> **Note:** Please add the **all_good_inventory** table to your FabApp database before running any of the code, otherwise the inventory will not display correctly. Thank-you.


## Vision:

Provide UTA - FabLab and other similar maker spaces high-quality and cost-effective scalable inventory management integrated Point of Sale system in which staff and admin can facilitate the purchase of goods.


## Scheduling the email alert with crontab
> edit the crontab from the bash 
$ sudo crontab -e
add a new line to execute the php script at the specified time
**eg:** * * 8,13 * * * php -q /pathTo/run_alert.php
save and exit crontab
the script will be executed everyday a 8 am and 13 pm

