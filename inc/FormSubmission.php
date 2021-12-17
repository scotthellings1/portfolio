<?php


class FormSubmission
{

    protected $first_name, $last_name, $email, $subject, $message;

    /**
     * FormSubmition constructor.
     * @param $data
     */
    public function __construct($formData)
    {
        $this->first_name = $formData['first_name'];
        $this->last_name = $formData['last_name'];
        $this->email = $formData['email'];
        $this->subject = $formData['subject'];
        $this->message = $formData['message'];
    }

    public function store()
    {
        global $db;
        try {
            $query = 'INSERT INTO contacts (first_name, last_name, email,  subject, message) 
                  VALUES (:first_name, :last_name, :email, :subject, :message)';
            $results = $db->prepare($query);
            $results->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
            $results->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
            $results->bindValue(':email', $this->email, PDO::PARAM_STR);
            $results->bindValue(':subject', $this->subject, PDO::PARAM_STR);
            $results->bindValue(':message', $this->message, PDO::PARAM_STR);
            $results->execute();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return true;
    }
}
