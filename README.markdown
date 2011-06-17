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
      flashdata API of the standard CodeIgniter session class.
    * Provide standard mechanism for classifying flashdata into three
      categories:
        * Notices: Good things; Success messages.
        * Messages: Generic message of neutral information
        * Warnings: Report bad things such as errors or bad form input.

Examples of the alternative syntax
----------------------------------

### Standard Session:
    $this->session->set_userdata('key', 'value');
    $this->session->set_flashdata('flashkey', 'flashvalue');
    $key = $this->session->userdata('key');
### Fluent Session:
    $this->session->key = 'value';
    $this->session->flash->flashkey = 'flashvalue';
    $key = $this->session->key;


