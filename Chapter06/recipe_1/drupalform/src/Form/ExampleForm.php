<?php

namespace Drupal\drupalform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
      return ['drupalform.company'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalform_example_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Company name'),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form,  FormStateInterface $form_state) {
    // Validation covered in later recipe, required to satisfy interface. 
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form,  FormStateInterface $form_state) {
    // Submission covered in later recipe, required to satisfy interface
  }
}
