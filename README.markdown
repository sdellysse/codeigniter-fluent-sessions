Fluent Sessions for CodeIgniter
===============================
What does 'Fluent' mean?
------------------------

A 'Fluent' API is one that takes advantage of language features to make using
said API less of a chore, and, many times, more self-descriptive.

What does Fluent Sessions for CodeIgniter bring to the table?
-------------------------------------------------------------

Fluent Sessions has two functions:

* Provide an alternate API to smooth over the wrinkles in the userdata and
* Provide standard mechanism for classifying flashdata into three
  categories:
  * Notices: Good things; Success messages.
  * Messages: Generic message of neutral information
  * Warnings: Report bad things such as errors or bad form input.

Examples of the alternative syntax
----------------------------------

### Standard Session:
    $this->session->set_userdata('key', 'value');
    $key = $this->session->userdata('key');
    $this->session->set_userdata('another_key', 'another value');
    $this->session->unset_userdata('key');
    $this->session->unset_userdata('another_key');
    $this->session->set_flashdata('flashkey', 'flashvalue');
    $this->session->sess_destroy();
### Fluent Session:
    $this->session->key = 'value';
    $key = $this->session->key;
    $this->session->another_key = 'another value';
    $this->session->clear();
    $this->session->flash->flashkey = 'flashvalue';
    $this->session->destroy();


