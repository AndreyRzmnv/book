<template>
    <div class="tile">
        <div class="content">
            {{$t('hellow')}}
        </div>
    </div>
</template>
<script>
    export default {
        name: 'Tile'
    }
</script>
<style lang="scss">
    .tile {
        display: flex;
        position: relative;
        width: calc(5% - 10px);
        margin: 5px;
        padding: 5px;
        word-wrap: break-word;
        color: #fff;
        background-color: #2a58da;
    }
    @media (max-width: 1500px) {
        .tile {
            width: calc(100%/20 - 10px);
        }
    }
    @media (max-width: 1450px) {
        .tile {
            width: calc(100%/19 - 10px);
        }
    }
    @media (max-width: 1400px) {
        .tile {
            width: calc(100%/18 - 10px);
        }
    }
    @media (max-width: 1350px) {
        .tile {
            width: calc(100%/17 - 10px);
        }
    }
    @media (max-width: 1300px) {
        .tile {
            width: calc(100%/16 - 10px);
        }
    }
    @media (max-width: 1250px) {
        .tile {
            width: calc(100%/15 - 10px);
        }
    }
    @media (max-width: 1200px) {
        .tile {
            width: calc(100%/14 - 10px);
        }
    }
    @media (max-width: 1150px) {
        .tile {
            width: calc(100%/13 - 10px);
        }
    }
    @media (max-width: 1100px) {
        .tile {
            width: calc(100%/12 - 10px);
        }
    }
    @media (max-width: 1050px) {
        .tile {
            width: calc(100%/11 - 10px);
        }
    }
    @media (max-width: 1000px) {
        .tile {
            width: calc(100%/10 - 10px);
        }
    }
    @media (max-width: 900px) {
        .tile {
            width: calc(100%/9 - 10px);
        }
    }
    @media (max-width: 800px) {
        .tile {
            width: calc(100%/8 - 10px);
        }
    }
    @media (max-width: 700px) {
        .tile {
            width: calc(100%/7 - 10px);
        }
    }
    @media (max-width: 600px) {
        .tile {
            width: calc(100%/6 - 10px);
        }
    }
    @media (max-width: 500px) {
        .tile {
            width: calc(100%/5 - 10px);
        }
    }
    @media (max-width: 400px) {
        .tile {
            width: calc(100%/4 - 10px);
        }

    }
    @media (max-width: 300px) {
        .tile {
            width: calc(100%/3 - 10px);
        }
    }
    @media (max-width: 200px) {
        .tile {
            width: calc(100%/2 - 10px);
        }
    }
    .tile:after {
        content: "";
        display: block;
        padding-bottom: 100%;
    }

    .content {
        position: absolute;
        width: calc(100% - 10px);
        height: calc(100% - 10px);
    }
</style>