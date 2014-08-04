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
		return '<li><a class="btn btn-default" href="'.$url.'&'.$query_extras.'">'.$page.'</a></li>';
	}

	/**
	 * Get HTML wrapper for disabled text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	public function getDisabledTextWrapper($text)
	{
        return '<li><button class="btn btn-default" disabled><span>'.$text.'</span></button></li>';
	}

	/**
	 * Get HTML wrapper for active text.
	 *
	 * @param  string  $text
	 * @return string
	 */
    public function getActivePageWrapper($text)
    {
        return '<li><button class="btn btn-default" disabled><span>'.$text.'</span></button></li>';
    }

    public function getPrevious($text = '&laquo;')
    {
        $currentPage = $this->paginator->getCurrentPage();

        $query_extras = http_build_query(Input::except('page'));
        $firstUrl = $this->paginator->getUrl(1) . '&' . $query_extras;
        $previousUrl = $this->paginator->getUrl($currentPage - 1) . '&' . $query_extras;

        $ret = '';
        if ($currentPage > 2) {
            $ret.= "<li><a class='btn btn-default' href='".$firstUrl."'><span>&laquo;</span></a></li>";
        }

        if ($currentPage > 1) {
            $ret.= "<li><a class='btn btn-default' href='".$previousUrl."'><span>".$text."</span></a></li>";
        }

        return $ret;
    }

    public function getNext($text = '&raquo;')
    {
        $currentPage = $this->paginator->getCurrentPage();
        $lastPage = $this->paginator->getLastPage();

        $query_extras = http_build_query(Input::except('page'));
        $lastUrl = $this->paginator->getUrl($lastPage) . '&' . $query_extras;
        $nextUrl = $this->paginator->getUrl($currentPage + 1) . '&' . $query_extras;

        $ret = '';
        if ($currentPage < $lastPage) {
            $ret.= "<li><a class='btn btn-default' href='".$nextUrl."'><span>".$text."</span></a></li>";
        }

        if ($currentPage < ($lastPage - 1)) {
            $ret.= "<li><a class='btn btn-default' href='".$lastUrl."'><span>&raquo;</span></a></li>";
        }

        return $ret;
    }
}

