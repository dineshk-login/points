<?php
class add
{
  public $x;
  public $y;
  function set_add($x,$y)
{
  $this->name = $a;
}
function get_a()
{
  return $this->a;
}
function set_b($b)
{
  $this->b = $b;
}
function get_b()
{
  return $this->b;
}
}
  $add = new adding();
  $add->set_a('10');
  $add->set_b('20');
  echo "the total is: " . $add->get_a()+$add->get_b();
?>


