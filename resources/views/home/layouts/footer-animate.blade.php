<div class="social-button" data-no-optimize="1" data-no-lazy="1"
    style="background-color:transparent !important; border-color: transparent !important;">
    <div class="social-button-content" data-no-optimize="1" data-no-lazy="1" style="display:none">
        <a href="tel:+84888018939" class="call-icon" rel="nofollow" data-no-optimize="1" data-no-lazy="1">
            <i class="fa fa-phone-square" aria-hidden="true"></i>
            <div class="animated alo-circle" data-no-optimize="1" data-no-lazy="1"></div>
            <div class="animated alo-circle-fill" data-no-optimize="1" data-no-lazy="1"></div>
            <span>Hotline: 0888018939</span>
        </a>
        <a href="https://www.facebook.com/sachnoi.trithucnhanloai" class="mes" data-no-optimize="1" data-no-lazy="1">
            <i class="fab fa-facebook-square" aria-hidden="true" data-no-optimize="1" data-no-lazy="1"></i>
            <span>Message Facebook</span>
        </a>
        <a href="https://zalo.me/0888018939" class="sms" data-no-optimize="1" data-no-lazy="1">
            <i class="fab fa-whatsapp" aria-hidden="true"></i>
            <span>Zalo</span>
        </a>
        <a href="mailto:trithucnhanloai.com@gmail.com" class="zalo" data-no-optimize="1" data-no-lazy="1">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>Send Email</span>
        </a>
    </div>

    <a class="user-support">
        <i class="fas fa-share-alt" aria-hidden="true" data-no-optimize="1" data-no-lazy="1"></i>
        <div class="animated alo-circle" data-no-optimize="1" data-no-lazy="1"></div>
        <div class="animated alo-circle-fill" data-no-optimize="1" data-no-lazy="1"></div>
    </a>
</div>

<style>
    @keyframes rung {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }

        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }

        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }

        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }

        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }

        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }

        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }

        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }

        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }

        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }

        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    .social-button-content a i:hover,
    .hide-rung {
        animation: rung 0.6s;
        animation-iteration-count: infinite;
    }

    .social-button {
        display: inline-grid;
        position: fixed;
        bottom: 15px;
        left: 25px;
        min-width: 45px;
        text-align: center;
        z-index: 99999;
    }

    .social-button-content {
        display: inline-grid;
    }

    .social-button a {
        padding: 8px 0;
        cursor: pointer;
        position: relative;
    }

    .social-button i {
        width: 40px;
        height: 40px;
        background: #4267b2;
        color: #fff;
        border-radius: 100%;
        font-size: 20px;
        text-align: center;
        line-height: 1.9;
        position: relative;
        z-index: 999;
    }

    .social-button span {
        display: none;
    }

    .alo-circle {
        animation-iteration-count: infinite;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-name: zoomIn;
        width: 50px;
        height: 50px;
        top: 3px;
        right: -3px;
        position: absolute;
        background-color: transparent;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid rgba(30, 30, 30, 0.4);
        opacity: .1;
        border-color: #365899;
        opacity: .5;
    }

    .alo-circle-fill {
        animation-iteration-count: infinite;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-name: pulse;
        width: 60px;
        height: 60px;
        top: -2px;
        right: -8px;
        position: absolute;
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid transparent;
        background-color: rgba(50, 53, 53, 0.29);
        opacity: .75;
    }

    .call-icon:hover>span,
    .mes:hover>span,
    .sms:hover>span,
    .zalo:hover>span {
        display: block
    }

    .social-button a span {
        border-radius: 2px;
        text-align: center;
        background: rgb(66, 103, 178);
        padding: 9px;
        display: none;
        width: 180px;
        margin-left: 25px;
        position: absolute;
        color: #ffffff;
        z-index: 999;
        top: 9px;
        left: 40px;
        transition: all 0.2s ease-in-out 0s;
        -moz-animation: headerAnimation 0.7s 1;
        -webkit-animation: headerAnimation 0.7s 1;
        -o-animation: headerAnimation 0.7s 1;
        animation: headerAnimation 0.7s 1;
    }

    @-webkit-keyframes "headerAnimation" {
        0% {
            margin-top: -70px;
        }

        100% {
            margin-top: 0;
        }
    }

    @keyframes "headerAnimation" {
        0% {
            margin-top: -70px;
        }

        100% {
            margin-top: 0;
        }
    }

    .social-button a span:before {
        content: "";
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 10px 10px 10px 0;
        border-color: transparent rgb(66, 103, 178) transparent transparent;
        position: absolute;
        left: -10px;
        top: 10px;
    }
</style>
<script>
    $(document).ready(function () {
        var defaultToggleState = true;
        var localStorageValue = localStorage["displayToggled"];
        // if localStorageValue not set then use default
        var displayToggled = localStorageValue === undefined ? defaultToggleState : localStorageValue;

        localStorage["displayToggled"] = displayToggled;

        if (localStorage["displayToggled"] == 'true') {
            $('.social-button-content').show();
            $('.user-support').removeClass("hide-rung");
        } else {
            $('.social-button-content').hide();
            $('.user-support').addClass("hide-rung");
        }

        $('.user-support').click(function (event) {
            var value = localStorage["displayToggled"];
            localStorage["displayToggled"] =
                value === undefined ? false : (value === "true" ? false : true);
            $('.social-button-content').slideToggle(function (event) {
                $('.user-support').toggleClass("hide-rung");
            });
        });
    });
</script>
