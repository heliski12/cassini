<?php 

class MotionryPaginationPresenter extends Illuminate\Pagination\Presenter {

	/**
	 * Get HTML wrapper for a page link.
	 *
	 * @param  string  $url
	 * @param  int  $page
	 * @return string
	 */
	public function getPageLinkWrapper($url, $page)
	{
        $query_extras = http_build_query(Input::except('page'));
        if ($page == 'prev') {
            return '<li class="active"><a href="'.$url.'&'.$query_extras.'"><span class="glyphicon glyphicon-chevron-left"></span></a></li>';
        } else {
            return '<li class="active"><a href="'.$url.'&'.$query_extras.'"><span class="glyphicon glyphicon-chevron-right"></span></a></li>';
        }
	}

	/**
	 * Get HTML wrapper for disabled text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	public function getDisabledTextWrapper($text)
	{
        if ($text == 'prev') {
            return '<li class="disabled"><span class="glyphicon glyphicon-chevron-left"></span></li>';
        } else {
            return '<li class="disabled"><span class="glyphicon glyphicon-chevron-right"></span></li>';
        }
	}

	/**
	 * Get HTML wrapper for active text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	public function getActivePageWrapper($text)
	{
		return '<li class="active"></li>';
	}

}

