<?php

require_once('models/User.php');

interface MovieDAOInterface {

  public function buildMovie($data);
  public function findAll();
  public function getLatestMovies();
  public function getMoviesByCategory($category);
  public function getMoviesByUserId($userId);
  public function findById($id);
  public function findByTitle($title);
  public function create(Movie $movie);
  public function update(Movie $movie);
  public function destroy($id);
}

?>
