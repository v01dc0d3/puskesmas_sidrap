<style>
.navbar {
    background-color: rgba(255, 255, 255, 0.7) !important;
    transition: 0.5s;
}
.nav-item:hover {
    background-color: rgba(255, 255, 255, 1) !important;
    transition: 0.5s;
}

.jumbotron {
    width: 100%;
    height: 90vh;
    background-image: url('<?= base_url('assets/images/sistem/for_jumbotron.jpg') ?>');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
    box-shadow: inset 0 0 0 1000px rgba(0,0,0,.4);
}

.bg-img {
    height: 60vh;
    position: relative;
    animation: levitate 2s infinite;
}

.bg-img:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 50%, white 100%);
    animation: levitate 2s infinite;
}

img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    animation: levitate 1.5s infinite;
}
@keyframes levitate {
    0%,
    100% {
        top: 0;
    }
    50% {
        top: 2px;
    }
}
</style>

</head>
<body>