Fluent Sessions for CodeIgniter
===============================
What does 'Fluent' mean?
------------------------

A 'Fluent' API is one that takes advantage of language features to make using
said API less of a chore, and, many times, more self-descriptive.

What does Fluent Sessions for CodeIgniter bring to the table?
-------------------------------------------------------------

Fluent Sessions has two functions:
- Provide an alternate API to smooth over the wrinkles in the userdata and
- Provide standard mechanism for classifying flashdata into three

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


