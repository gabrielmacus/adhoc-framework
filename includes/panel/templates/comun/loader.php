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
            stroke-dasharray: 1,200;
            stroke-dashoffset: 0;
        }
        50%{
            stroke-dasharray: 89,200;
            stroke-dashoffset: -35;
        }
        100%{
            stroke-dasharray: 89,200;
            stroke-dashoffset: -124;
        }
    }
</style>