sugarcrm-update-calculated-fields
=================================

Simple script which can be called by the scheduler nightly to force calculated fields to be updated.
I used this to update a days since field was changed type field.


1. Copy calcFieldsUpdater.php to somewhere in your /custom folder (example assumes you put it /custom/calcFieldsUpdater.php)
2. Open /custom/include/MVC/Controller/entry_point_registry.php (create if doesn't exist)
3. Add the following to it:
  ```
  $entry_point_registry['calcFieldsUpdater'] = array (
    'file' => 'custom/calcFieldsUpdater.php',
    'auth' => true,
  );
  ```
  
4. Create a scheduler of type url, specify https://<your_comain>/sugarcrm/index.php?entryPoint=calcFieldsUpdater
5. Set the time for when you want it to run (such as once a night).


![gitimg](https://gitimg.com/blak3r/sugarcrm-update-calculated-fields/README/track)
