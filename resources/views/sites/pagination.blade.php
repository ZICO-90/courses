
<div class="inner col-xs-12 text-center">
    @if($paginator->hasPages())
          <ul class="pagination">

              <!---return boolean----->
               @if($paginator->onFirstPage())
                      <li class="disabled">
                          <a href="{{$paginator->PreviousPageUrl()}}" style="pointer-events: none;"  onclick="return false" aria-label="Previous" >
                            <span aria-hidden="true">»</span>
                          </a>
                      </li>
               @else
                      <li >
                          <a href="{{$paginator->PreviousPageUrl()}}" aria-label="Previous">
                            
                              <span aria-hidden="false">«</span>
                          </a>
                      </li>
               @endif

               @if(is_array($elements[0]))
                    @foreach($elements[0] as $pageNumber => $Url)
                    <li class="{{$pageNumber == $paginator->currentPage()||url()->current() == $Url ?  'active': '' }}"><a  href="{{$Url}}">{{$pageNumber}}</a></li>
                    @endforeach
               
               @endif
          
               @if($paginator->hasMorePages())
               
                     <li >
                         <a href="{{$paginator->nextPageUrl()}}" aria-label="Next">
                             <span aria-hidden="false">»</span>
                         </a>
                     </li>
               
               @else
                     <li class="disabled"> 
                         <a href="{{$paginator->nextPageUrl()}}"  style="pointer-events: none;"  onclick="return false" aria-label="Next">
                             <span aria-hidden="true">»</span>
                         </a>
                     </li>
                     
               @endif
              

          </ul>
    @endif
</div>
<!-- end inner -->