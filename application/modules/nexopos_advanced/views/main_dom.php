<spinner></spinner>
<ng-view></ng-view>
<style>
.sp-64 {
	width: 64px;
	height: 64px;
    float:left;
}
.sp-32 {
	width: 32px;
	height: 32px;
    float:left;
}
.sp-40 {
    width: 35px;
    height: 35px;
    float: left;
}
.sp-margin-5 {
    margin: 7px;
}
/* Spinner Circle Rotation */
.sp-circle {
	border: 4px rgba(60, 141, 188, 0.27) solid;
    border-top: 4px rgb(60, 141, 188) solid;
    border-radius: 50%;
    -webkit-animation: spCircRot .4s infinite linear;
    animation: spCircRot .4s infinite linear;
}
.sp-circle-light {
	border: 4px rgba(255, 255, 255, 0.27) solid;
    border-top: 4px rgb(255, 255, 255) solid;
    border-radius: 50%;
    -webkit-animation: spCircRot .8s infinite linear;
    animation: spCircRot .8s infinite linear;
}
@-webkit-keyframes spCircRot {
	from { -webkit-transform: rotate(0deg); }
	to { -webkit-transform: rotate(359deg); }
}
@keyframes spCircRot {
	from { transform: rotate(0deg); }
	to { transform: rotate(359deg); }
}
.hidden {
    display:none;
}
</style>

