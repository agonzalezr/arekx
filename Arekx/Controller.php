<?php namespace Arekx;

interface Controller {
    public function default();
    public function add();
    public function update();
    public function list();
    public function show($id);
    public function delete();
}