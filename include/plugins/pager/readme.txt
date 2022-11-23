usage:

$midas_pager = new pager($reccnt, $pagesize, $start);
$midas_pager->show_pager();
$midas_pager->show_displaying();

or 

midas_pager::static_pager($reccnt, $pagesize, $start);
midas_pager::static_displaying($reccnt, $pagesize, $start);


to change theme
$midas_pager = new pager($reccnt, $pagesize, $start, 'new_theme');
or
$midas_pager->theme = 'default';


if you have created a new pager template you can simply include that file.