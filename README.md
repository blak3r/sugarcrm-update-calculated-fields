sugarcrm-update-calculated-fields
=================================

Simple script which can be called by the scheduler nightly to force calculated fields to be updated.
I used this to update a days since field was changed type field.


1. Copy calcFieldsUpdater.php to somewhere in your /custom folder (example assumes you put it /custom/calcFieldsUpdater.php)
2. Modify the top of the script to specify the module you want to run this for and an optional filter.
3. Open /custom/include/MVC/Controller/entry_point_registry.php (create if doesn't exist)
4. Add the following to it:
  ```
  $entry_point_registry['calcFieldsUpdater'] = array (
    'file' => 'custom/calcFieldsUpdater.php',
    'auth' => true,
  );
  ```
  
4. Create a scheduler of type url, specify https://<your_comain>/sugarcrm/index.php?entryPoint=calcFieldsUpdater
5. Set the time for when you want it to run (such as once a night).

## Blog Post
For more information on how this can be used along with workflow rules see this blog post:
<http://www.blakerobertson.com/devlog/2013/2/19/sugarcrm-update-calculated-fields-nightly.html>

## Compatibility
This will only work on on-site versions of Sugar until an installable module is created.  The process of doing so tends to 
take way longer then this code took to write in the first place.  If someone wants to fund getting this turned into an installable module, please contact me through me here: <http://www.blakerobertson.com/contact> and I'll make it available to the community afterwards.  


![gitimg](https://gitimg.com/blak3r/sugarcrm-update-calculated-fields/README/track)
