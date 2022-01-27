<?php
// session_start();
// require_once 'config/config.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
// define('BASE_PATH', dirname(dirname(__FILE__)));
// define('APP_FOLDER', 'simpleadmin');
// define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));
// require_once 'includes/auth_validate.php';

// //require_once BASE_PATH . '/includes/auth_validate.php';
// include "../vendor/autoload.php";
// require_once '../vendor/stefangabos/zebra_pagination/Zebra_Pagination.php';
// $db = getDbInstance();
// $records_per_page = 10;
// $pagination = new Zebra_Pagination();
// if(isset($_GET['search_str']))
// {
//     $search_data=$_GET['search_str'];

//     $users = $db->rawQuery('SELECT ofUser.username, MAX(case when ofUserProp.name = \'contact_no\' then ofUserProp.propValue else 0 end) as contact_no, MAX(case when ofUserProp.name = \'blue_tick\' then ofUserProp.propValue else \'false\' end) as blue_tick	 FROM ofUser,ofUserProp 
// WHERE ofUser.username=ofUserProp.username and ofUser.username like "%'.$search_data.'%"  group by ofUser.username  LIMIT
//         ' . (($pagination->get_page() - 1) * $records_per_page)   . $records_per_page . '');

// }
// else
// {
//     $users = $db->rawQuery('SELECT ofUser.username, MAX(case when ofUserProp.name = \'contact_no\' then ofUserProp.propValue else 0 end) as contact_no, MAX(case when ofUserProp.name = \'blue_tick\' then ofUserProp.propValue else \'false\' end) as blue_tick	 FROM ofUser,ofUserProp 
// WHERE ofUser.username=ofUserProp.username group by ofUser.username  LIMIT
//         ' . (($pagination->get_page() - 1) * $records_per_page)  . $records_per_page . '');
// }




// $mysql_count_Query=$db->rawQueryOne('SELECT COUNT(*) as count FROM ofUser');
// $pagination->records($mysql_count_Query["count"]);
// $pagination->records_per_page($records_per_page);
$users = array("username"=>"dikshant", "contact_no"=>"37", "Joe"=>"43");

?>


</script>
<?php include_once('includes/header.php'); ?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Vendors</h1>
        </div>

    </div>
    

    <!-- Filters -->
    <div class="well text-center filter-form ce">
        <form class="form form-inline" action="" >
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_str" value="<?php if(isset($_GET['search_str'])) echo $search_data?>">

            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="20%">user name</th>
                <th width="20%">contact no</th>
                <th width="20%">blue tick</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>

                <td>

<div class="align-content-xl-center"
     >


                </td>


            </tr>
            <!-- Delete Confirmation Modal -->
            <!-- //Delete Confirmation Modal -->
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">


   <?php
//    $pagination->labels('Previous', 'Next');
//    echo $pagination->render();?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->


<?php include '/includes/footer.php'; ?>
