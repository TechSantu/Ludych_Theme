<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post_id;

$about_text        = get_field( 'about_text', $post_id );
$about_title       = get_field( 'about_title', $post_id );
$about_description = get_field( 'about_description', $post_id );
$about_image       = get_field( 'about_image', $post_id );
$author_name       = get_field( 'author_name', $post_id );
$author_about      = get_field( 'author_about', $post_id );
?>


	<!-- our work progress start -->
	<section class="work-progress">
		<div class="custom-container">
			<div class="global-header middle-align">
				<h2>Technology Stack</h2>
				<div class="min-title">
					<div class="icon-box">
						<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
							<path
								d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z"
								fill="url(#a)" />
							<defs>
								<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311"
									gradientUnits="userSpaceOnUse">
									<stop stop-color="#3D72FB" />
									<stop offset="1" stop-color="#fff" />
								</linearGradient>
							</defs>
						</svg>
					</div>
					<h6>Next-Gen Technology Stack</h6>
				</div>
				<h5>AI, Data Science & Full-Stack Development <span>One Agency, Complete Capabilities.</span></h5>
			</div>
			<div class="row">
				<div class="col-3">
					<div class="list-group" id="list-tab" role="tablist">
						<a class="list-tab-panel-btn list-tab-panel-btn-action active" id="list-tabOne-list"
							data-bs-toggle="list" href="#list-One" role="tab" aria-controls="list-One">Artificial
							Intelligence</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabTwo-list"
							data-bs-toggle="list" href="#list-Two" role="tab" aria-controls="list-Two">Frontend</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabThree-list"
							data-bs-toggle="list" href="#list-Three" role="tab" aria-controls="list-Three">Backend</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabFour-list"
							data-bs-toggle="list" href="#list-Four" role="tab" aria-controls="list-Four">Frameworks</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabFive-list"
							data-bs-toggle="list" href="#list-Five" role="tab" aria-controls="list-Five">Mobile</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabSix-list"
							data-bs-toggle="list" href="#list-Six" role="tab" aria-controls="list-Six">Hi-Tech</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabSeven-list"
							data-bs-toggle="list" href="#list-Seven" role="tab" aria-controls="list-Seven">Platforms /
							BI Tools</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabEight-list"
							data-bs-toggle="list" href="#list-Eight" role="tab"
							aria-controls="list-Eight">CMS/Ecommerce</a>
						<a class="list-tab-panel-btn list-tab-panel-btn-action" id="list-tabNine-list"
							data-bs-toggle="list" href="#list-Nine" role="tab" aria-controls="list-Nine">Cloud /
							Devops</a>
					</div>
				</div>
				<div class="col-9">
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="list-One" role="tabpanel"
							aria-labelledby="list-tabOne-list">
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
									fill="none">
									<path
										d="M23.4552 0.000392611C21.4975 0.00948873 19.628 0.176446 17.9831 0.46752C13.1373 1.32362 12.2574 3.11551 12.2574 6.42006V10.7844H23.7087V12.2391H12.2574H7.95987C4.6318 12.2391 1.71765 14.2395 0.806144 18.0449C-0.24527 22.4067 -0.291906 25.1286 0.806144 29.683C1.62014 33.0732 3.56408 35.4887 6.89215 35.4887H10.8294V30.2569C10.8294 26.4772 14.0996 23.1432 17.9831 23.1432H29.421C32.605 23.1432 35.1467 20.5217 35.1467 17.3242V6.42006C35.1467 3.31669 32.5287 0.98546 29.421 0.46752C27.4539 0.140061 25.4128 -0.00870364 23.4552 0.000392611ZM17.2624 3.51052C18.4452 3.51052 19.4112 4.49225 19.4112 5.69935C19.4112 6.90217 18.4452 7.87483 17.2624 7.87483C16.0753 7.87483 15.1136 6.90217 15.1136 5.69935C15.1136 4.49225 16.0753 3.51052 17.2624 3.51052Z"
										fill="url(#paint0_linear_303_66)"></path>
									<path
										d="M36.5748 12.239V17.324C36.5748 21.2664 33.2324 24.5845 29.421 24.5845H17.9831C14.85 24.5845 12.2574 27.266 12.2574 30.4036V41.3077C12.2574 44.4111 14.956 46.2364 17.9831 47.1268C21.6079 48.1926 25.084 48.3852 29.421 47.1268C32.304 46.2921 35.1467 44.6122 35.1467 41.3077V36.9434H23.7087V35.4886H35.1467H40.8723C44.2004 35.4886 45.4406 33.1672 46.598 29.6829C47.7935 26.0958 47.7427 22.6463 46.598 18.0447C45.7755 14.7316 44.2046 12.239 40.8723 12.239H36.5748ZM30.1418 39.8529C31.3288 39.8529 32.2905 40.8256 32.2905 42.0284C32.2905 43.2355 31.3288 44.2172 30.1418 44.2172C28.9589 44.2172 27.993 43.2355 27.993 42.0284C27.993 40.8256 28.9589 39.8529 30.1418 39.8529Z"
										fill="url(#paint1_linear_303_66)"></path>
									<defs>
										<linearGradient id="paint0_linear_303_66" x1="-1.42598e-07" y1="-1.23871e-07"
											x2="26.4054" y2="22.5011" gradientUnits="userSpaceOnUse">
											<stop stop-color="#5A9FD4"></stop>
											<stop offset="1" stop-color="#306998"></stop>
										</linearGradient>
										<linearGradient id="paint1_linear_303_66" x1="29.8666" y1="41.6615" x2="20.3933"
											y2="28.3866" gradientUnits="userSpaceOnUse">
											<stop stop-color="#FFD43B"></stop>
											<stop offset="1" stop-color="#FFE873"></stop>
										</linearGradient>
									</defs>
								</svg>
								<h6>Python</h6>
							</div>
						</div>
						<div class="tab-pane fade" id="list-Two" role="tabpanel" aria-labelledby="list-tabTwo-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Three" role="tabpanel" aria-labelledby="list-tabThree-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Four" role="tabpanel" aria-labelledby="list-tabFour-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Five" role="tabpanel" aria-labelledby="list-tabFive-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Six" role="tabpanel" aria-labelledby="list-tabSix-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Seven" role="tabpanel" aria-labelledby="list-tabSeven-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Eight" role="tabpanel" aria-labelledby="list-tabEight-list">
							python
						</div>
						<div class="tab-pane fade" id="list-Nine" role="tabpanel" aria-labelledby="list-tabNine-list">
							python
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>