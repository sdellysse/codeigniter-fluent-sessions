Fluent Sessions for CodeIgniter
===============================
What does 'Fluent' mean?
------------------------

A 'Fluent' API is one that takes advantage of language features to make using
said API less of a chore, and, many times, more self-descriptive. A fluent API
attempts to require the user to only use as little of the parent language as
possible to describe what they are wanting to do.

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

Note the differences in the two code samples above. The standard CI Session
class requires you to pollute your intention with function calls just to set
and get data from the session. Fluent Sessions, on the other hand, uses a
clearer syntax to set a key/value pair.

Fluent Session flash categories:
--------------------------------

### Example controller code:
    $this->session->flash->warnings['username'] = 'Cannot be blank';
    $this->session->flash->warnings['passwords'] = 'Must match';
### Example view code:
    <?php if (count($this->session->flash->warnings)): ?>
        <ul>
            <?php foreach ($this->sessions->flash->warnings as $field => $message): ?>
                <li><?php echo $field ?>: <?php echo $message ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
### Generates:
    <ul>
        <li>username: Cannot be blank</li>
        <li>passwords: Must match</li>
    </ul>

Due to these being part of flash data, just like any other flash data, they will
only persist for one subsequent page load.

Installation:
-------------
Copy libraries/MY\_Session into your application/libraries directory.

