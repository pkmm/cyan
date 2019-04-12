<template>
    <div>
      <div class="container">
          <div class="flex-center position-ref full-height">
      
            <div class="content">
                <div class="title m-b-md">
                    {{lover}}
                </div>
            </div>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                lover: "世界你好"
            }
        }
    }
</script>

<style type="less">
    /*.item-move{
        transition: all .5s cubic-bezier(.55,0,.1,1);
        -webkit-transition: all .5s cubic-bezier(.55,0,.1,1);
    }*/
    body {
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        background-image: url("/img/main-page-bg.jpg");
    }
/*html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }*/
    
</style>