<template>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
            <h1>404</h1>
            <h2>Oops! Not Found</h2>
            <p>
                It appear this page doesn't exist or don't you have a permission to visit it
            </p>
            <a href="/">Go To Home Page</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotFound"
    }
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Nunito:400,700');

    #notfound {
        font-family: 'Nunito', sans-serif;
    }

    #notfound {
        position: relative;
        height: 100vh;
        background: #fff;
    }

    #notfound .notfound {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .notfound {
        max-width: 560px;
        width: 100%;
        padding-left: 160px;
        line-height: 1.1;
    }

    .notfound .notfound-404 {
        position: absolute;
        left: 0;
        top: 0;
        display: inline-block;
        width: 140px;
        height: 140px;
        /*background-image: url('/storage/boxes/emoji.png');*/
        background-size: cover;
    }

    .notfound .notfound-404:before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-transform: scale(2.4);
        -ms-transform: scale(2.4);
        transform: scale(2.4);
        border-radius: 50%;
        background-color: #f2f5f8;
        z-index: -1;
    }

    .notfound h1 {
        font-family: 'Nunito', sans-serif;
        font-size: 65px;
        font-weight: 700;
        margin-top: 0px;
        margin-bottom: 10px;
        color: #151723;
        text-transform: uppercase;
    }

    .notfound h2 {
        font-family: 'Nunito', sans-serif;
        font-size: 21px;
        font-weight: 400;
        margin: 0;
        text-transform: uppercase;
        color: #151723;
    }

    .notfound p {
        font-family: 'Nunito', sans-serif;
        color: #999fa5;
        font-weight: 400;
    }

    .notfound a {
        font-family: 'Nunito', sans-serif;
        display: inline-block;
        font-weight: 700;
        border-radius: 40px;
        text-decoration: none;
        color: #388dbc;
    }

    @media only screen and (max-width: 767px) {
        .notfound .notfound-404 {
            width: 110px;
            height: 110px;
        }

        .notfound {
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 110px;
        }
    }
</style>
