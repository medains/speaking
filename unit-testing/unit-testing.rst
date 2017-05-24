:skip-help: true
:title: What not to do
:author: Colin Ameigh
:description: The Hovercraft! tutorial.
:keywords: unit testing
:css: tutorial.css

.. title:: What not to do

----

:data-x: 0
:data-y: 0
:data-rotate: 0

What not to do
=====================

----

:class: inactivehidden
:data-x: 0
:data-y: 0

What not to do
=====================

A guided tour of unit testing
_____________________________

----

:data-x: r0
:data-y: r900

Colin Ameigh
================

About me

.. note::
  Some notes

----

:data-x: r-300
:data-y: r1170
:data-rotate: r30 

Pyramid
========

.. note::

  So we’re all familiar with the test pyramid.
  
  A broad base of unit tests, supporting a handful of integration tests, supporting a few full system tests.
  What everyone sees is the shiny exterior of this pyramid, giving them confidence in the product.
  
  The reality is that the unit tests, the foundation of the pyramid, are often rotten – held together by spit and twigs and manual interventions.
  
  Sometimes it seems best just to burn the whole lot and start again.
  
  So lets look at unit testing, I find it best to view things through counterexamples.

----

:data-x: r-854
:data-y: r854
:class: codeslide

.. include:: example1.php

.. note::

   Counterexample

   This is not a unit test

   It appears to be part way between a system test and integration test - tying most elements of the system together in the “dispatch” method.

   Notes
   * use of a loader to set up a database… so the database needs to exist and be running on the environment the test is running in
   * contents of the database can be changed by config changes
   * our desired test behaviour is overriding some kinds of database lookup anyway

----

:data-x: r-1170
:data-y: r300
:class: codeslide coderight

.. image:: atomic.png
  :class: left middle
  :width: 220px

.. include:: atomic.php

.. note::

  Atomic - runs alone without needing other tests to run before or after.
  Excessively simplified to prove the point - the testMultiplyValue will fail if run alone,
  unless the class actually has “15” as a default value, in which case the first test is useless.

----

:data-x: r-1170
:data-y: r-300
:class: codeslide coderight

.. image:: trustworthy.png
  :class: left middle
  :width: 220px

.. include:: trustworthy.php

.. note::

  
  Trustworthy - runs anywhere - dev machine, docker container, CI flow.
  Should not depend on external processes, particular paths etc.. setting up all the dependencies itself.
  This example seems straightforward, but will fail if the timezone is ‘America/Los_Angeles’ for example.

----

:data-x: r-854
:data-y: r-854
:class: codeslide coderight

.. image:: readable.png
  :class: left middle
  :width: 220px

.. include:: readable.php

.. note::

  Maintainable - code quality should equal or exceed production code.
  Readable - can you work it out just by reading.
  This example fails on both fronts, with mixed tabs and spaces, inconsistent indents, poor variable naming, spelling issues and bad test names (to be fair to the author of the test I used as an example here, the formatting, variable names and spelling I’ve deliberately made much worse, but the original isn’t still hard to understand)

----

:data-x: r-300
:data-y: r-1170
:class: codeslide

.. include:: badstructure.php

.. note::

  First a badly structured test - this is a bit of a mess and when split over several files can be hard to determine what is going on

  We’ll skim over the fact that this is not a unit test either

----

:data-x: r300
:data-y: r-1170
:class: codeslide

.. include:: goodstructure.php

.. note::

  Next, something much clearer:
  If you can clearly break your test up into these sections it will be more readable.
    1,2 setup
    3 execute
    4 verify
    5,6 teardown
  It seems obvious, but some of this often gets mixed up - and is not always clear.

  In the spirit of leaving things better than we found them - lets go back to that badly structured test and improve it.

----

:data-x: r854
:data-y: r-854
:class: codeslide

.. include:: impstructure.php

.. note::

  So login is now called in setup, and will not fail the test if it fails, but skip it.

  Verify sometimes gets mixed in with setup when using mocks… so lets talk a bit about mocks

----

:data-rotate: r-30 
:class: codeslide coderight

.. image:: dummy.png
  :class: left middle
  :width: 220px

.. include:: dummy.php

.. note::

  You may have heard of Mocks, Stubs and Spies.

  Specifying what is returned:
  Dummies - don’t care whether they are called, always return nul

----

:data-x: r300
:data-y: r-1170
:class: codeslide coderight

.. image:: stub.png
  :class: left middle
  :width: 220px

.. include:: stub.php

.. note::

   Stubs - don’t care what they are called with, or how many times, always return fixed value.


----

:data-x: r0
:data-y: r-900
:data-rotate: r0 
:class: codeslide coderight

.. image:: fake.png
  :class: left middle
  :width: 220px

.. include:: fake.php

.. note::

  Fake - don’t care how many times they are called, have simple logic to map arguments -> return value

----

.. image:: spy.png

.. note::

  What if we need to know how it was called:
  Spy - counts invocations and arguments (PHPUnit easy spies with $spy=$this->any())  (Spies can be dummy spies, stub spies or fake spies)

  Mocks can be used to describe all of these, but often they exert also assertions over how they are called - spies with assertions built in (I prefer spies)  This can be useful as shorthand in tests.

----

:data-y: r-2400
:data-x: r700

Let's look at some examples
==================================

----

:data-y: r0
:data-x: r0
:class: codeslide inactivehidden

.. include:: testconstructor.php

.. note::

  Notes

----

:data-y: r0
:data-x: r-1400
:class: codeslide

.. include:: testreturntype.php

.. note::

  Notes

----

:data-y: r-1000
:data-x: r0
:class: codeslide

.. include:: testhiddendep.php

.. note::

  Notes

----

:data-y: r0
:data-x: r1400

:class: codeslide

.. include:: testbigsetup.php

.. note::

  Notes

----

:data-y: r-1000
:data-x: r0

Other problems
==============================

.. note::

  Notes

----

:data-y: r0
:data-x: r-1400
:class: codeslide

.. include:: bewaremockery.php

.. note::

  Notes

----

:data-rotate: r720
:data-scale: 25
:data-x: r-700
:data-y: r6000
:class: laststep

