<?php

namespace Drupal\drupalform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {

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
  $form['phone'] = [
    '#type' => 'tel',
    '#title' => $this->t('Phone'),
  ];
  $form['email'] = [
    '#type' => 'email',
    '#title' => $this->t('Email'),
  ];
  $form['integer'] = [
    '#type' => 'number',
    '#title' => $this->t('Some integer'),
    // The increment or decrement amount
    '#step' => 1,
    // Miminum allowed value
    '#min' => 0,
    // Maxmimum allowed value
    '#max' => 100,
  ];
  $form['date'] = [
    '#type' => 'date',
    '#title' => $this->t('Date'),
    '#date_date_format' => 'Y-m-d',
  ];
  $form['website'] = [
    '#type' => 'url',
    '#title' => $this->t('Website'),
  ];
  $form['search'] = [
    '#type' => 'search',
    '#title' => $this->t('Search'),
    '#autocomplete_route_name' => FALSE,
  ];
  $form['range'] = [
    '#type' => 'range',
    '#title' => $this->t('Range'),
    '#min' => 0,
    '#max' => 100,
    '#step' => 1,
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
    // Validation covered in later recipe, required to satisfy interface
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form,  FormStateInterface $form_state) {
    // Submission covered in later recipe, required to satisfy interface
  }
}
