<script>
    $( document ).ajaxStop(function() {
        $(".loader").removeClass("active");
    });
    $( document ).ajaxStart(function() {
        $(".loader").addClass("active");
        $(".loader .info").html("");
    });
    
</script>
<div class="loader">
    <svg class="circular">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>

<style>
    .loader {
        position: fixed;
        top: 15px;
        right: 15px;
        z-index: 100000;
    }

    .circular {
        animation: rotate 1s linear infinite;
        height: 100px;
        position: relative;
        width: 100px;
        zoom: 2;
    }


    .path {
        stroke: gray;
        stroke-dasharray: 1,200;
        stroke-dashoffset: 0;
        animation: dash 1.5s ease-in-out infinite;
        stroke-linecap: round;
    }

    @keyframes rotate {
        100%{
            transform: rotate(360deg);
        }
    }
    @keyframes dash{
        0%{
           stroke: #F44336;
            stroke-dasharray: 1,200;
            stroke-dashoffset: 0;
            zoom: 1;
        }
        50%{
            stroke: #FFEB3B;
            stroke-dasharray: 89,200;
            stroke-dashoffset: -35;
            zoom: 1.5;
        }
        75%{
            stroke: #4CAF50;
            stroke-dasharray: 89,200;
            stroke-dashoffset: -35;
            zoom: 1;
        }

        100%{
            stroke: #2196F3;
            stroke-dasharray: 89,200;
            stroke-dashoffset: -124;
            zoom: 1.5;
        }
    }
</style>