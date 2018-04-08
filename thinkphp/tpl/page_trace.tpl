<div id="think_page_trace" style="position: fixed;bottom:0;right:0;font-size:14px;width:100%;z-index: 999999;color: #000;text-align:left;font-family:'微软雅黑';">
    <div id="think_page_trace_tab" style="display: none;background:white;margin:0;height: 250px;">
        <div id="think_page_trace_tab_tit" style="height:30px;padding: 6px 12px 0;border-bottom:1px solid #ececec;border-top:1px solid #ececec;font-size:16px">
            <?php foreach ($trace as $key => $value) {?>
            <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700"><?php echo $key ?></span>
            <?php }?>
        </div>
        <div id="think_page_trace_tab_cont" style="overflow:auto;height:212px;padding:0;line-height: 24px">
            <?php foreach ($trace as $info) {?>
            <div style="display:none;">
                <ol style="padding: 0; margin:0">
                    <?php
                    if (is_array($info)) {
                        foreach ($info as $k => $val) {
                            echo '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">' . (is_numeric($k) ? '' : $k.' : ') . htmlentities(print_r($val,true), ENT_COMPAT, 'utf-8') . '</li>';
                        }
                    }
                    ?>
                </ol>
            </div>
            <?php }?>
        </div>
    </div>
    <div id="think_page_trace_close" style="display:none;text-align:right;height:15px;position:absolute;top:10px;right:12px;cursor:pointer;"><img style="vertical-align:top;" src="data:image/gif;base64,R0lGODlhDwAPAJEAAAAAAAMDA////wAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUQxMjc1MUJCQUJDMTFFMTk0OUVGRjc3QzU4RURFNkEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUQxMjc1MUNCQUJDMTFFMTk0OUVGRjc3QzU4RURFNkEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxRDEyNzUxOUJBQkMxMUUxOTQ5RUZGNzdDNThFREU2QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxRDEyNzUxQUJBQkMxMUUxOTQ5RUZGNzdDNThFREU2QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgH//v38+/r5+Pf29fTz8vHw7+7t7Ovq6ejn5uXk4+Lh4N/e3dzb2tnY19bV1NPS0dDPzs3My8rJyMfGxcTDwsHAv769vLu6ubi3trW0s7KxsK+urayrqqmop6alpKOioaCfnp2cm5qZmJeWlZSTkpGQj46NjIuKiYiHhoWEg4KBgH9+fXx7enl4d3Z1dHNycXBvbm1sa2ppaGdmZWRjYmFgX15dXFtaWVhXVlVUU1JRUE9OTUxLSklIR0ZFRENCQUA/Pj08Ozo5ODc2NTQzMjEwLy4tLCsqKSgnJiUkIyIhIB8eHRwbGhkYFxYVFBMSERAPDg0MCwoJCAcGBQQDAgEAACH5BAAAAAAALAAAAAAPAA8AAAIdjI6JZqotoJPR1fnsgRR3C2jZl3Ai9aWZZooV+RQAOw==" /></div>
</div>
<div id="think_page_trace_open" style="height:30px;float:right;text-align:right;overflow:hidden;position:fixed;bottom:0;right:0;color:#000;line-height:30px;cursor:pointer;">
    <div style="background:#232323;color:#FFF;padding:0 6px;float:right;line-height:30px;font-size:14px"><?php echo \think\Container::get('debug')->getUseTime().'s ';?></div>
    <img width="30" style="" title="ShowPageTrace" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NzhDODdFRTYzODk5MTFFOEE1OUNBRkE0MTNEMTcxMjQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NzhDODdFRTczODk5MTFFOEE1OUNBRkE0MTNEMTcxMjQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3OEM4N0VFNDM4OTkxMUU4QTU5Q0FGQTQxM0QxNzEyNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3OEM4N0VFNTM4OTkxMUU4QTU5Q0FGQTQxM0QxNzEyNCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pijyi1kAAAROSURBVHja1FpLTBNRFD0tLW1p+YgoWAqo8RPU+IkLlBhj1BASozEuTEzcuFAXxoWJC1dK1I2JMSZu3Bhd+CO6UTEuJMZPNCCJYqLgDwVBPopKbfkUELzXZ+OH94Z2pszQm7zOdN7Mmznv3XfuuW/GVnh2tBrAcioDVGzQYSvz4DxfhuxHnYgcqkHo3Xf8wMTaKBU3lesO+llNxWmktblZgMNODfnhur0ZrstvgBNPgS8DmGhbwQC+Usk10soM7599BrJ9PrBtHnCwBjj/Ckiju+xbSr2UAoQHgR4qTUGgrov+DxkC0ONIRDcEfGOPpZAzri8QABbnALsWjT0nREAuvgZOP6de1Dla9kQAyEuTH38bFNvZGfL69FRgNwG7uRGYmWERAJ9TDeBDSGxnjfNwfnLBC2XAVLcFALLdagAfe8W2MD02N9y50AIA3LupKfK69vBvF8qMra3Ns4HiKfHd3/Ak7u4H+oYF0/xtTKFd/WL/TAP1MLlJZATYMFP9kMxmJXlA4zcTR+AFkfCqq8DZRhFdosasEmWWy8Q0xykunHoGlF8DHrSr21uQbQELcW9X1AKlV4Cq5n/9X2Yn69V1OW6TXWgpcfwguUYDjUQ7PfSeu0ClH/g+qD1qbWF5/FDNpwkbgSMrgFubgP3L/syD++Qi9d3qawZJKX2LyOtGRk0E4KUYkOMR+3uXADVbgR3FJBnGadVmE5JDZv3DJgLITRNxIGqZFFkrSoB7W4ACn/o6HilV0IpXABoCwAHMLfHZfN+/Au9/m06jNsUlr+voNXkEZBakCdwS0o66MjcbJjJoDpkIoEghEZiNtFxBFZn5mqgANAVAvsJNuvpEb6psXpb8+EuKwB/DJgII+OL3Y49DyAWZ1X3Sjh8JBcCTN18BoE2jF8sK1fnBk08mqtFpHsEmMmsKqqX3geXq5Odhh4kAuPc9CiESzXNdKSK15KC1ktymslwkLzK79Frfc+jWQlqB6lipkApuh5ANzPlacYEzN9MB+L3ao5Pvi70tltq9OlcndLtQUQYSYucoj7j2Tv/1ukdAlQfHY5ypHX5srA1dAHhy5hoAwDR7tI5keIvxTtAFYKrGSgTr+SGKwnabWGjl/xGayN0DIpGpeg9Ut4pzEmG6ADD/+xSrqQdrxUNynGDdzwCYVj/3a8sLUwGoJATLgDttgkJVGVeiTRcLqRaqeiKip800XQBUMrqzTwSuSQ8goEPETRoAzC5+BYCWUBIAYPpUJeStyQKAVx+kAJLBhfIUIo4DE6eSkx5AgUYaacJLPeMAVAzEvW/whZ21ADoscJ+4AXBqqAJgBQPFDeBXapg2eYJY3AB4IcvrTFIAnMSw+9glX1Ow3rcSQEwfeMzJBIoV76+YPjutmcQ2BhDTi801AWBtQE2h8b6YSJBlcUJznco6jPO5jccBL1W6KKtyUrIywify2yDKvOz13eijfTN5iG/PgubGTwEGAIrCLnq1ytQbAAAAAElFTkSuQmCC">
</div>

<script type="text/javascript">
    (function(){
        var tab_tit  = document.getElementById('think_page_trace_tab_tit').getElementsByTagName('span');
        var tab_cont = document.getElementById('think_page_trace_tab_cont').getElementsByTagName('div');
        var open     = document.getElementById('think_page_trace_open');
        var close    = document.getElementById('think_page_trace_close').children[0];
        var trace    = document.getElementById('think_page_trace_tab');
        var cookie   = document.cookie.match(/thinkphp_show_page_trace=(\d\|\d)/);
        var history  = (cookie && typeof cookie[1] != 'undefined' && cookie[1].split('|')) || [0,0];
        open.onclick = function(){
            trace.style.display = 'block';
            this.style.display = 'none';
            close.parentNode.style.display = 'block';
            history[0] = 1;
            document.cookie = 'thinkphp_show_page_trace='+history.join('|')
        }
        close.onclick = function(){
            trace.style.display = 'none';
            this.parentNode.style.display = 'none';
            open.style.display = 'block';
            history[0] = 0;
            document.cookie = 'thinkphp_show_page_trace='+history.join('|')
        }
        for(var i = 0; i < tab_tit.length; i++){
            tab_tit[i].onclick = (function(i){
                return function(){
                    for(var j = 0; j < tab_cont.length; j++){
                        tab_cont[j].style.display = 'none';
                        tab_tit[j].style.color = '#999';
                    }
                    tab_cont[i].style.display = 'block';
                    tab_tit[i].style.color = '#000';
                    history[1] = i;
                    document.cookie = 'thinkphp_show_page_trace='+history.join('|')
                }
            })(i)
        }
        parseInt(history[0]) && open.click();
        tab_tit[history[1]].click();
    })();
</script>
