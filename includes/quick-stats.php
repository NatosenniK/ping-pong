<div class="row">

                        <!-- Top Player -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                This Week's Top Player</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php
												if($res = mysqli_query($conn, "SELECT users.user_ID,
															users.username AS username,
															COUNT(games.WinnerID) AS wins, games.Date
														FROM users, games
														WHERE games.WinnerID = users.user_ID
                                                        AND games.Date >= CURRENT_DATE() - 7
														GROUP BY users.user_ID
                                                        ORDER BY wins desc
														LIMIT 1;")) {
															while($row = mysqli_fetch_assoc($res))
															{
															 ?>
																<?php echo $row['username']; ?>
																
																
																
																<?php
															}
														} else {
															echo("Error description: " . mysqli_error($conn));
														}
											?>
											
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-medal fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Most Wins  -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Most Wins</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php
											if($res = mysqli_query($conn, "SELECT  username,
														SUM(wins),
														SUM(loss),
														SUM(PF),
														SUM(PA),
														elo
														FROM (
														(SELECT users.user_ID,
															users.username AS username,
															COUNT(games.WinnerID) AS wins,
															0 AS loss,
															SUM(games.PointsFor) AS PF,
															SUM(games.PointsAgainst) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.WinnerID = users.user_ID
														GROUP BY users.user_ID)
														UNION ALL
														(SELECT users.user_ID,
															users.username AS username,
															0 AS wins,
															COUNT(games.LoserID) AS loss,
															SUM(games.PointsAgainst) AS PF,
															SUM(games.PointsFor) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.LoserID = users.user_ID
														GROUP BY users.user_ID)
														) AS t
														GROUP BY username
														ORDER BY wins desc
														LIMIT 1;")) {
															while($row = mysqli_fetch_assoc($res))
															{
															 ?>
																<?php echo $row['username']; ?>
																<?php
															}
														} else {
															echo("Error description: " . mysqli_error($conn));
														}
														?>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Most Points -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Most Points Scored</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php
												if($res = mysqli_query($conn, "SELECT  username,
														SUM(wins),
														SUM(loss),
														SUM(PF),
														SUM(PA),
														elo
														FROM (
														(SELECT users.user_ID,
															users.username AS username,
															COUNT(games.WinnerID) AS wins,
															0 AS loss,
															SUM(games.PointsFor) AS PF,
															SUM(games.PointsAgainst) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.WinnerID = users.user_ID
														GROUP BY users.user_ID)
														UNION ALL
														(SELECT users.user_ID,
															users.username AS username,
															0 AS wins,
															COUNT(games.LoserID) AS loss,
															SUM(games.PointsAgainst) AS PF,
															SUM(games.PointsFor) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.LoserID = users.user_ID
														GROUP BY users.user_ID)
														) AS t
														GROUP BY username
														ORDER BY SUM(PF) desc
														LIMIT 1;")) {
															while($row = mysqli_fetch_assoc($res))
															{
															 ?>
																<?php echo $row['username']; ?>
																<?php
															}
														} else {
															echo("Error description: " . mysqli_error($conn));
														}
											?>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-angle-double-up fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Top Rated Player -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Top Rated Player
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
													<?php
												if($res = mysqli_query($conn, "SELECT  username,
														SUM(wins),
														SUM(loss),
														SUM(PF),
														SUM(PA),
														elo
														FROM (
														(SELECT users.user_ID,
															users.username AS username,
															COUNT(games.WinnerID) AS wins,
															0 AS loss,
															SUM(games.PointsFor) AS PF,
															SUM(games.PointsAgainst) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.WinnerID = users.user_ID
														GROUP BY users.user_ID)
														UNION ALL
														(SELECT users.user_ID,
															users.username AS username,
															0 AS wins,
															COUNT(games.LoserID) AS loss,
															SUM(games.PointsAgainst) AS PF,
															SUM(games.PointsFor) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.LoserID = users.user_ID
														GROUP BY users.user_ID)
														) AS t
														GROUP BY username
														ORDER BY elo desc
														LIMIT 1;")) {
															while($row = mysqli_fetch_assoc($res))
															{
															 ?>
																<?php echo $row['username']; ?>
																
																
																
																<?php
															}
														} else {
															echo("Error description: " . mysqli_error($conn));
														}
											?>
													
													</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
														<div class="elo-rating">ELO: 
														
														<?php
												if($res = mysqli_query($conn, "SELECT  username,
														SUM(wins),
														SUM(loss),
														SUM(PF),
														SUM(PA),
														elo
														FROM (
														(SELECT users.user_ID,
															users.username AS username,
															COUNT(games.WinnerID) AS wins,
															0 AS loss,
															SUM(games.PointsFor) AS PF,
															SUM(games.PointsAgainst) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.WinnerID = users.user_ID
														GROUP BY users.user_ID)
														UNION ALL
														(SELECT users.user_ID,
															users.username AS username,
															0 AS wins,
															COUNT(games.LoserID) AS loss,
															SUM(games.PointsAgainst) AS PF,
															SUM(games.PointsFor) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.LoserID = users.user_ID
														GROUP BY users.user_ID)
														) AS t
														GROUP BY username
														ORDER BY elo desc
														LIMIT 1;")) {
															while($row = mysqli_fetch_assoc($res))
															{
															 ?>
																<?php echo $row['elo']; ?>
																
																
																
																<?php
															}
														} else {
															echo("Error description: " . mysqli_error($conn));
														}
											?>
														
														</div>
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 95%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>